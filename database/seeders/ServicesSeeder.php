<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'Android',
                'text' => 'Android — операционная система для смартфонов, планшетов, электронных книг, цифровых проигрывателей, наручных часов, фитнес-браслетов, игровых приставок, ноутбуков, нетбуков, смартбуков, очков Google Glass, телевизоров, проекторов и других устройств.',
                'icon' => 'fa-android'
            ],
            [
                'name' => 'Apple IOS',
                'text' => 'iOS — мобильная операционная система для смартфонов, электронных планшетов, носимых проигрывателей и некоторых других устройств, разрабатываемая и выпускаемая американской компанией Apple. Была выпущена в 2007 году; первоначально — для iPhone и iPod touch, позже — для таких устройств, как iPad.',
                'icon' => 'fa-apple'
            ],
            [
                'name' => 'Веб-дизайн',
                'text' => 'Вид графического дизайна, направленный на разработку и оформление объектов информационной среды Интернета, призванный обеспечить им высокие потребительские свойства и эстетические качества. Подобная трактовка отделяет веб-дизайн от веб-программирования, подчеркивает специфику предметной деятельности веб-дизайнера, позиционирует веб-дизайн как вид графического дизайна',
                'icon' => 'fa-dropbox'
            ],
            [
                'name' => 'Концепция',
                'text' => 'Концепция сайта — это первый результат дизайна сайта в широком смысле этого слова. Она определяет каким будет сайт, чем он будет отличаться от конкурентов, каковы будут этапы развития сайта. Далее я расскажу, зачем, на наш взгляд вообще нужна концепция, в чём польза от её создания, как она влияет на процесс, а также как её оценивать.',
                'icon' => 'fa-html5'
            ],
            [
                'name' => 'Исследование пользователей',
                'text' => 'Исследование пользователей это методология направленная на понимание конечного пользователя и цели приложения.',
                'icon' => 'fa-slack'
            ],
            [
                'name' => 'Опыт взаимодействия',
                'text' => 'UX используется для описания субъективного отношения, возникающего у пользователя в процессе использования как информационной системы в целом, так и отдельной её части (веб-сайта, приложения и пр.). Опыт пользователя, в том числе, связан с таким понятием как юзабилити, применяемым при разработке и анализе пользовательских интерфейсов приложений.',
                'icon' => 'fa-users'
            ]
        ]);
    }
}