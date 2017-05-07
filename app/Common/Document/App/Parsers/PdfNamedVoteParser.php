<?php

namespace App\Common\Document\App\Parsers;

use App\Common\Document\Concern\Reader\ParseDocumentException;
use App\Common\Document\Concern\ValueObjects\ParsedVote;
use App\Common\Document\Concern\ValueObjects\ParsedVoteCollection;
use App\Common\Document\Concern\ValueObjects\ParsedVoter;
use App\Common\Document\Contracts\DocumentInterface;
use App\Common\Document\Contracts\DocumentParserInterface;
use App\Common\Laravel\Filesystem\Contracts\FileSystemFactoryAwareInterface;
use App\Common\Laravel\Filesystem\Traits\FilesystemFactoryAware;
use App\Common\Vote\Concern\ValueObjects\Decision;
use App\Common\Vote\Concern\ValueObjects\Voice;
use Carbon\Carbon;
use Smalot\PdfParser\Parser;

class PdfNamedVoteParser implements DocumentParserInterface, FileSystemFactoryAwareInterface
{
    use FilesystemFactoryAware;

    protected const SUPPORTED_DOCUMENT_EXTENSION = 'pdf';

    protected const REGEX_VOTES_CONTENT = '~Система поіменного голосування(?P<content>.*)~';
    protected const REGEX_ITEM_TOPIC = '~Результат поіменного голосування\:(?P<topic>.*)    №~';
    protected const REGEX_ITEM_NUMBER = '~№\: (\d+)  (.*)№ п/п~';
    protected const REGEX_ITEM_DATE = '~~';
    protected const REGEX_ITEM_APPROVED_AMOUNT = '~~';
    const REGEX_ITEM_DECLINED_AMOUNT = '';
    const REGEX_ITEM_ABSTAINED_AMOUNT = '';
    const REGEX_ITEM_NOT_VOTED_AMOUNT = '';
    const REGEX_ITEM_MISSED_AMOUNT = '';
    const REGEX_ITEM_DECISION = '';
    const REGEX_ITEM_COUNCIL = '';
    const REGEX_ITEM_SESSION = '';
    const REGEX_ITEM_CONVOCATION = '';
    const REGEX_ITEM_VOTE_TYPE = '';
    const REGEX_ITEM_VOTERS_WITH_VOTE = '';

    /**
     * @var Parser
     */
    private $parser;

    /**
     * PdfNamedVoteParser constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param DocumentInterface $document
     * @return bool
     */
    public function supports(DocumentInterface $document): bool
    {
        return $document->getExtension() === static::SUPPORTED_DOCUMENT_EXTENSION;
    }

    /**
     * @param DocumentInterface $document
     * @return ParsedVoteCollection
     */
    public function parseVotes(DocumentInterface $document): ParsedVoteCollection
    {
        $votes = [];
        $content = $this->filesystemFactory->disk($document->getDisk())
            ->get($document->getFullPath());

        $pdf = $this->parser->parseContent($content);

        preg_match_all($this->getVotesContentRegex(), $pdf->getText(), $votesContent);

        foreach ((array) $votesContent['content'] as $index => $voteItem) {

            //$voteItem = 'Система поіменного голосування &#34;Рада Голос&#34;Броварська міська рада23 позачергова сесія міської ради від 22.12.16Результат поіменного голосування:Про перехід до додатковиї питань №1 та №2. №: б/н За пропозицію№ п/пПрізвище, ім&#39;я та по-батькові депутатаРезультатголосування№ п/пПрізвище, ім&#39;я та по-батькові депутатаРезультатголосування1Сапожко Ігор ВасильовичЗа2Бабич Петро ІвановичЗа3Мельник Оксана МиколаївнаЗа4Лемпіцький Валерій АнатолійовичЗа5Оксютенко Володимир МиколайовичЗа6Тоцька Тетяна ПетрівнаЗа7Сенько Лідія ІванівнаЗа8Темченко Людмила ГригорівнаЗа9Василенко Андрій ПетровичЗа10Скотніков Юрій АнатолійовичНе голосував11Чаюн Володимир ГригоровичЗа12Крилова Тетяна МиколаївнаЗа13Семенов Максим ВолодимировичЗа14Бойко Сергій ОлександровичНе голосував15Шевчук Олег СергійовичУтримався16Здоровець Олексій МихайловичНе голосував17Андрієвський Вадим АнатолійовичЗа18Коваленко Вікторія МиколаївнаЗа19Кочубей Василь МихайловичЗа20Гредунов Євгеній ВалерійовичЗа21Іваненко Валерій ІвановичЗа22Черепейнік Леонід ВолодимировичНе голосував23Веремчук Ірина СергіївнаЗа24Опалько Володимир ГригоровичЗа25Батюк Сергій ІвановичНе голосував26Бельський Сергій КостянтиновичЗа27Негода Галина ВасилівнаУтримався28Тютюнник Андрій АнатолійовичЗа29Мутило Вадим АнатолійовичЗа30Дудко Борис ВолодимировичЗа31Чередник Юрій ПавловичЗа32Дяченко Аліна ОлексіївнаВідсутній33Лопатюк Андрій МихайловичЗа34Берестовий Олег ІгоровичНе голосував35Зінченко Микола АндрійовичЗа36Саук Андрій МиколайовичВідсутній37Білокінь Володимир ОлексійовичЗа ПІДСУМКИ ГОЛОСУВАННЯ&#34;За&#34; - 27 &#34;Проти&#34; - 0 &#34;Утрималися&#34; - 2Не брали участі у голосуванні - 6Відсутні на пленарному засіданні - 2Рішення: ПРИЙНЯТО(прийнято / не прийнято)';

            preg_match($this->getVoteDetailsRegex(), $voteItem, $parsed);

            if (! isset($parsed['topic'])) {
                throw new \Exception(
                    'Index' . $index.
                    'Message ' . $voteItem
                );
            }

//            if ($index == 61) {
//                dump($voteItem, $parsed);
//            }


            $votes[] = (new ParsedVote)
                ->setTopic(trim($parsed['topic']))
                ->setNumber($this->makeNumber($parsed['number']))
                ->setDate($this->makeDate($parsed['dateYear'], $parsed['dateMonth'], $parsed['dateDay']))
                ->setApprovedAmount((int) $parsed['approvedAmount'])
                ->setDeclinedAmount((int) $parsed['declinedAmount'])
                ->setAbstainedAmount((int) $parsed['abstainedAmount'])
                ->setNotVotedAmount((int) $parsed['notVotedAmount'])
                ->setMissedAmount((int) $parsed['missedAmount'])
                ->setDecision($this->makeDecision($parsed['decision']))
                ->setCouncil(trim($parsed['council']) . ' рада')
                ->setSession(trim($parsed['session']))
                //->setConvocation($this->parseConvocation($voteItem))
                ->setType(trim($parsed['type']))
                ->setVoters($this->parseVotersWithVote($parsed['votersTable']))
           ;
        }

        return new ParsedVoteCollection($votes);
    }

    /**
     * @param string $content
     * @return array
     */
    protected function parseVotersWithVote(string $content)
    {
        preg_match_all($this->getVotersRegex(), $content, $voters);

        $parsedVoters = [];

        for ($i = 0; $i < count($voters['id']); ++$i) {
            $parsedVoters[] = new ParsedVoter(
                trim($voters['lastname'][$i]) . trim($voters['name'][$i]) . trim($voters['surname'][$i]),
                $this->makeVoice(trim($voters['voice'][$i]))
            );
        }

        return $parsedVoters;
    }

    /**
     * @param $value
     * @return Voice
     */
    protected function makeVoice($value)
    {
        $voice = null;

        switch (strtolower($value)) {
            case 'за':
                $voice = Voice::VOICE_APPROVED;
                break;
            case 'проти':
                $voice = Voice::VOICE_DECLINED;
                break;
            case 'утримався':
                $voice = Voice::VOICE_ABSTAINED;
                break;
            case 'не голосував':
                $voice = Voice::VOICE_NOT_VOTED;
                break;
            case 'відсутній':
                $voice = Voice::VOICE_MISSED;
                break;
        }

        return new Voice($voice);
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return Carbon
     */
    protected function makeDate($year, $month, $day)
    {
        $year = trim($year);
        $month = trim($month);
        $day = trim($day);

        return Carbon::createFromDate(
            strlen($year) === 4 ? $year : substr(date('Y'), 0, 2) . $year,
            $month,
            $day
        );
    }

    /**
     * @param $number
     * @return int|string
     */
    protected function makeNumber($number)
    {
        return is_numeric(trim($number)) ? trim($number) : 0;
    }

    /**
     * @param $decision
     * @return Decision
     */
    protected function makeDecision($decision)
    {
        return strtolower($decision) === 'прийнято'
            ?   new Decision(Decision::DECISION_APPROVED)
            :   new Decision(Decision::DECISION_DECLINED);
    }

    /**
     * @param string $message
     * @throws \RuntimeException
     */
    protected function throwParseException($message = 'Parse exception', $original)
    {
        throw new ParseDocumentException($message . ' in ' . $original);
    }

    protected function getVotesContentRegex()
    {
        return '~(?P<content>Система поіменного голосування.*)~';
    }

    protected function getVoteDetailsRegex()
    {
        return '~Система поіменного голосування \&\#34\;Рада Голос\&\#34\;(?P<council>.*)рада(?P<session>\d+) позачергова сесія.* від (?P<date>(?P<dateDay>\d{2})\.(?P<dateMonth>\d{2})\.(?P<dateYear>\d{2,4}))Результат поіменного голосування\:(?P<topic>.*)\s+№: (?P<number>\d+\S+|\d+|бн|б/н)\s+(?P<type>.*)№ п\/пПрізвище, ім\&\#39\;я та по-батькові депутатаРезультатголосування№ п/пПрізвище, ім\&\#39\;я та по-батькові депутатаРезультатголосування(?P<votersTable>.*)\s+ПІДСУМКИ ГОЛОСУВАННЯ\&\#34\;За\&\#34\; - (?P<approvedAmount>\d+).*&#34;Проти&#34; - (?P<declinedAmount>\d+).*\&\#34\;Утрималися\&\#34\; - (?P<abstainedAmount>\d+)Не брали участі у голосуванні - (?P<notVotedAmount>\d+)Відсутні на пленарному засіданні - (?P<missedAmount>\d+)Рішення: (?P<decision>.*)\(прийнято \/ не прийнято\)~';
    }

    /**
     * @return string
     */
    protected function getVotersRegex()
    {
        return '~(?P<id>\d+)(?P<lastname>\S+) (?P<name>\S+) (?P<surname>\S+)(?P<voice>За|Проти|Не голосував|Відсутній|Утримався)~';
    }
}
