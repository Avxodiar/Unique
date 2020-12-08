<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'name' => 'home',
                'alias' => 'home',
                'content' => '<h2>Мы создаем <strong>удивительные</strong> веб-шаблоны</h2>
              <p>Разнообразный и богатый опыт консультация с широким активом требуют от нас анализа системы обучения кадров, соответствует насущным потребностям. Разнообразный и богатый опыт постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач.</p>',
                'images' => 'main_device.png'
            ],
            [
                'name' => 'О нас',
                'alias' => 'about',
                'content' => '<p>Разнообразный и богатый опыт дальнейшее развитие различных форм деятельности в значительной степени обуславливает создание системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что сложившаяся структура организации играет важную роль в формировании системы обучения кадров, соответствует насущным потребностям.</p><p>С другой стороны дальнейшее развитие различных форм деятельности в значительной степени обуславливает создание системы обучения кадров, соответствует насущным потребностям. Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности позволяет оценить значение соответствующий условий активизации. Идейные соображения высшего порядка, а также новая модель организационной деятельности требуют определения и уточнения существенных финансовых и административных условий.</p>',
                'images' => 'about.jpg'
            ],
        ]);
    }
}
