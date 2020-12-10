<section id="team" class="page_section team"><!--main-section team-start-->
    <div class="container">
    @if(!empty($peoples) && is_array($peoples))
        <h2>Team</h2>
        <h6>Прототип нового сервиса - это как шопот бессменных лидеров</h6>
        <div class="team_section clearfix">
        @foreach($peoples as $key => $people)
            <div class="team_area">
                <div class="team_box wow fadeInDown delay-0{{($key+1)*3}}s">
                    <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
                    {!! Html::image('assets/img/' . $people['images'], $people['name']) !!}
                    <ul>
                        <li><a href="javascript:void(0)" class="fa fa-twitter"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-facebook"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-pinterest"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-google-plus"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-03s">{{ $people['name'] }}</h3>
                <span class="wow fadeInDown delay-03s">{{ $people['position'] }}</span>
                <p class="wow fadeInDown delay-03s">{{ $people['text'] }}</p>
            </div>
        @endforeach
        </div>
    @endif
    </div>
</section>
