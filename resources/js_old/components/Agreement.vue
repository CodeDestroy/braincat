<template>
    <div class="bg-white py-4 sm:py-8" id="content-to-convert">
        <div class="mx-auto max-w-6xl text-left">
            <div class="border-b border-gray-200 pb-5 mb-7">
                <h2 class="text-lg sm:text-2xl font-semibold leading-6 text-gray-900 px-4 sm:px-8">Согласие на обработку персональных данных</h2>
            </div>
        </div>
        <div class="container mx-auto max-w-6xl text-base text-left bg-white px-4 sm:px-8">
            <p class="indent-8 pb-4">Я, в соответствии с Федеральным законом от 27.07.2006 № 152-ФЗ «О персональных данных» свободно, своей волей и в своем интересе даю конкретное, предметное, информированное, сознательное и однозначное согласие оператору персональных данных – автономной некоммерческой организации дополнительного профессионального образования "Форум" (адрес места нахождения: Россия, 394077, Воронежская Область, г. Воронеж, б-р Победы, д.13) (далее – Организация) на обработку моих персональных данных в следующих целях:</p>            
            <ol role="list" class="nested py-4">
                <li v-for="item in items" :key="item.id">
                    <strong class="text-purple-800">Регистрации на Сайте и получение доступа к предоставляемым cайтом сервисам.</strong>
                    <ol class="nested">
                        <li>Мои персональные данные, в отношении которых дается данное согласие, включают: фамилию, имя, место работы (или место обучения), должность (или класс/курс обучения), номер телефона, адрес электронной почты, город.</li>
                        <li>Действия с моими персональными данными включают: сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, доступ работников Организации, передачу иным лицам в случаях, предусмотренных законодательством Российской Федерации, блокирование, удаление, уничтожение персональных данных.</li>
                        <li>Согласие действует 3 года с момента регистрации на Сайте Организации.</li>
                    </ol>
                </li>
                <li v-for="item in items" :key="item.id">
                    <strong class="text-purple-800">Обеспечения участия в образовательном процессе, включая подготовку высококвалифицированных кадров по всем основным направлениям общественно полезной деятельности в соответствии с потребностями общества и государства, удовлетворение потребностей личности в интеллектуальном, культурном и нравственном развитии, углублении и расширении образования.</strong>
                    <ol class="nested">
                        <li>Мои персональные данные, в отношении которых дается данное согласие, включают: фамилию, имя, отчество, пол, сведения об основном документе, удостоверяющем личность (серия, номер, дата выдачи, наименование органа, выдавшего документ, код подразделения (если имеется)), сведения о загранпаспорте (серия, номер, дата выдачи и срок действия, наименование выдавшего органа), СНИЛС, уровень владения иностранными языками, гражданство (резидентство), дата рождения, место рождения, адрес регистрации, адрес места жительства, фотографическое и видеоизображение (не относящееся к биометрическим персональным данным), сведения о семейном положении, номер телефона, адрес электронной почты, сведения об обучении (даты начала и окончания, наименование образовательной программы, дисциплина), сведения об успеваемости, посещаемости, промежуточных аттестациях, сведения о ранее полученном образовании, сведения о повышении квалификации и профессиональной переподготовке, сведения о текущем и предыдущих местах работы, опыте, занимаемых должностях, сведения о поощрениях.</li>
                        <li>Действия с моими персональными данными включают: сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, доступ работников Организации, передачу иным лицам в случаях, предусмотренных законодательством Российской Федерации, блокирование, удаление, уничтожение персональных данных.</li>
                        <li>Согласие действует 3 года с момента окончания обучения.</li>
                    </ol>
                </li>
                <li v-for="item in items" :key="item.id">
                    <strong class="text-purple-800">Участие в деятельности Сообщества Выпускников Организации и сохранение связи с ними, включая оказание поддержки и помощи Выпускникам и их проектам, участие в программе лояльности для выпускников; поддержка и сохранение традиций АНО ДПО "Форум".</strong>
                    <ol class="nested">
                        <li>Мои персональные данные, в отношении которых дается данное согласие, включают: фамилию, имя, отчество, дата рождения, адрес места жительства, фотографическое изображение (не относящееся к биометрическим персональным данным), номер телефона, адрес электронной почты, имя пользователя в мессенджере Telegram, сведения об обучении (наименование образовательной программы, номер группы, членство в клубах выпускников), сведения о месте работы и занимаемой должности.</li>
                        <li>Действия с моими персональными данными включают: сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, доступ работников Организации, передачу иным участникам Сообщества Выпускников Организации (в том числе путем публикации персональных данных на закрытом разделе сайта Организации), передачу иным лицам в случаях, предусмотренных законодательством Российской Федерации, блокирование, удаление, уничтожение персональных данных.</li>
                        <li>Согласие действует на период участия в деятельности Сообщества Выпускников Организации.</li>
                    </ol>
                </li>
                <li v-for="item in items" :key="item.id">
                    <strong class="text-purple-800">Предоставление возможности пожертвования денежных средств общему грантовому фонду и грантовым программам АНО ДПО "Форум", участия в программе лояльности.</strong>
                    <ol class="nested">
                        <li>Мои персональные данные, в отношении которых дается данное согласие, включают: фамилию, имя, номер телефона, адрес электронной почты, размер пожертвования, дата рождения, количество баллов программы лояльности, уровень программы лояльности.</li>
                        <li>Действия с моими персональными данными включают: сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, доступ работников Организации, передачу иным лицам в случаях, предусмотренных законодательством Российской Федерации, блокирование, удаление, уничтожение персональных данных.</li>
                        <li>Согласие действует на период участия в программе лояльности Организации.</li>
                    </ol>
                </li>
            </ol>
            <p class="indent-8 pb-4">Настоящее согласие распространяется на поручение обработки персональных данных лицам и в целях, указанных здесь.</p>
            <p class="indent-8 pb-4">Предусматривается смешанная обработка моих персональных данных – как без использования средств автоматизации, так и автоматизированная обработка с передачей полученной информации с использованием глобальной информационно-телекоммуникационной сети Интернет.</p>
            <p class="indent-8 pb-4">Организация вправе продолжить обработку моих персональных данных по окончанию действия согласия в случаях и в течение периода времени, предусмотренных законодательством Российской Федерации.</p>
            <p class="indent-8 pb-4">Мне известно, что я могу отозвать согласие на обработку персональных данных, указанных в настоящем согласии, подав Организации заявление на адрес электронной почты admin@psy4pro.ru в произвольной форме. В этом случае я не смогу быть зарегистрированным на Сайте Организации, получать информацию рекламного характера о деятельности Организации, участвовать в процессе адмиссии на образовательную программу и (или) мероприятие Организации, участвовать в программе лояльности Организации, участвовать в деятельности Сообщества Выпускников Организации.</p>
        </div>
    </div>
    </template>
    
    <script setup>
    const items = [
      { id: 1 },
      // More items...
    ]
    </script>