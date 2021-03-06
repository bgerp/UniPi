# ЕНЕРГО-ИЗМЕРВАТЕЛНА СИСИТЕМА

# ИЗМЕРВАТЕЛНИ ПРИБОРИ

**1. Анализ и предписания**

- Избира се точката за измерване на устройство (машина, прибор, съоражение)
- Взема се под внимание максималният ток на консумация и работното напрежение на устройството.
- Съобразява се дали максималният ток на консумация може да премие през измервателният прибор.
(В конкретният случай SDM630. Това означава 100А на фаза). Ако токът на консумация надвишава 100А,
е задължително да се използва токов трансформатор, който да намали максималният ток през измервателният прибор – SDM630.
- Измервателният прибор се монтира в непосредствена близост до устройството, което ще наблюдаваме.
- Трябва да се съобрази начина на монтаж на електрическите връзки.(шина, кабел)
- Необходимо е то да се свърже преди дефектно-токовите защити. По този начин се намалява
риска от увреждане на измервателният прибор при къси съединения предизвикани от устройството,
което наблюдаваме. Добра практика е да има дефектно-токови защити преди измервателният прибор.
Така се намалява риска от удари предизвикани от други консуматори в същият електрически клон.
- Поради факта, че ще се прави отдалечено наблюдение на консумираната енергия, това означава,
че измервателният прибор, e свързан към концентратор.
- Връзката между концентратора и измерителният прибор ще се осъществява посредством протокол за полева комуникация.
Данните се пренасят през усукана двойка със сечение 2 х 0,75 (мед) с метално фолио и обшивка.
Максималната дължина на цялата линия от концентратора до последното измервателно
устройство може да бъде с максимална дължина от 1200м. Дължината на линията е съобразена
със скоростта на данните пътуващи по линията.
Добра практика е линията да НЕ минава в близост до силови кабели (200V~ 800V),
особенно ако са свързани на към тях реактивни консуматори (двигатели, трансфомратори).
- При дължина на линията над 50м се препоръчва да се използват токови резистори със стойност 120Ома,
те ще намалят самоиндукцията в линията.

**2. Физически монтаж**
- Измервателният уред се монтира в таблото на устройството, което ще се наблюдава.
- Схемата на свързване е 4 проводна. [**Виж станица 20**](https://bg-etech.de/download/manual/SDM630-Mbus.pdf)

   **PE остава непроменен.**

| Захранване  | Прибор  |
| ----------- |:-------:|
| L1          | L1      |
| L2          | L2      |
| L3          | L3      |
| N           | N       |

_Таблица 1_

- Линията за комуникация с измервателният прибор се извежда максимално далеко от точката на измерване в кабелен канал,
в който няма силови кабели.
- Начина на свързване на комуникационната линия е право:
 
| Концентраотр  | Уво. ШИНА  |
| ------------- |:----------:|
| A             | A          |
| B             | B          |
| G             | PE         |
| N             | N          |

_Таблица 2_
- Топологията на свързване на MODBUS-RTU мрежата може да се види [**тук на Fig. 1**](http://www.bb-elec.com/Learning-Center/All-White-Papers/Serial/RS-485-Connections-FAQ.aspx)
- Работата на MODBUS-RTU мрежата може да се наруши ако не се спазва тази шинова топология.
- При дължина на трасето повече от 50 метра се препоръчват терминиращи резистори в двата края на трасето.
Те се свързват по следната [**схема**](https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Rs485-bias-termination.svg/220px-Rs485-bias-termination.svg.png).
За допълнителна информация прегледайте [**тази страница**](https://en.wikipedia.org/wiki/RS-485).

**3. Конфигуриране**
- В документацията на измервателният прибор е описано как се променят следните параметри – скорост на линията,
количество битове за данни, количество битове за край, контрол по четност, пореден номер на устройството в шината.
- Шината не се самоконфигурира, системният инженер се грижи за това.
В случай на измервателни прибори с еднакви поредни номера в шината ще възникне конфликт.
- Шината не подържа броудкаст номера.
- За коректната работа на измервателните прибори е необходимо всички устройства да бъдат
с еднакви комуникационни настройки с изключение на поредните номера в шината.

# КОНЦЕНТРАТОРИ

**1. Анализ и предписания**
- Поради съображения наложени от начина на комуникация **(MODBUS-RTU over RS485)** концентратора трябва да бъде в
единият край на лининията, независимо от количеството устройства. Топологии от типа звзда,
кръг, дърво и т.н. не са позволени.
- Максималният брой устройства свързани към един концентратор не трябва да надвишава 250бр. с поредни номера.
- Както е написано по-рано в същият документ линията не трябва да надвишава 1200м.

**2. Физически монтаж**
-  Концентратора се монтира в табло/шкаф максимално далеч от контактори, инвертори и реактивни устройства.
-  Концентратора се захранва с **24 VDC** от таблото/шкафа в който се монтира.
-  Концентратора разполага с  **PE**  клема, която се свързва с  **PE**  на таблото/шкафа.
Така се уеднаквяват потенциялите на концентратора спрямо другите устройства в ел. мрежата на съответният клон.
-  Концентратора се свързва посредством  **Ethernet** към интернет мрежата на учреждението.
Важно е този кабел да бъде отделен от силови кабели с напрежение **(200V ~ 800V)**.

**3. Конфигуриране**
-  Според документацията на производителя за свързване на концентратора с периферно устройство посредством **MODBUS-RTU** 
е необходимо да се създаде файл, който да опише картата с паметта на съответната преиферия.
В този случай  Файлът с конфигурация на съответното устройство има  **YAML**  текстова организация на съдържанието.
-  За улесняване работата по съставяне на този файл може да се използват готови файлове за ориентир.
**(Да се даде пътя до файла и опорна документация от производител.)**
-  За свързванена тази конфигурация е необходимо да се модифицира основен файл с конфигурация.
**(Да се даде пътя до файла и опорна документация от производител.)**
-  Концентратора е снабден с операционна сиситема  **Linux**. Тя се изпълнява основно от **RAM** паметта на концентатора.
-  За запис на данни в основният диск трябва да се извика командата  **sync**
-  [Разширители](https://evok.api-docs.io/1.0/mpqzDwPwirsoq7i5A/extensions), 
**/etc/hw\_definitions**, **/etc/evok.conf**

**4. Комуникация с централизирана сиситема**
-  С концентратора се комуникира през няколко спецификации/протокола –  **REST, SOAP, WEB-Socket, WEB-Interface.**
-  В нашият случай се използва [Виж документацията от производител.](https://evok.api-docs.io/1.0/rest/get-watchdog-state-watchdog-alias)
-  Централната система в този случай е [bgERP](https://bgerp.com/) , и е  **WEB**  базирана.
-  Начина на осъществяване на комуникация е посредством  **GET, POST**  и  **HEAD**  заявки от страна на системата.
-  За осъществяване комуникация с концентратора трябва да се изготви специален драйвер,
който да използва и преобразува данните от него.
-  Драйвера трябва да се конструира на езика. Той трябва да предлага данни съобразени в сиситема **SI** към централната система.

