<div id="content-page" class="content group">
    <div class="clear"></div>
    <div class="posts">
        <div class="group portfolio-post internal-post">

            @if($portfolio)

            <div id="portfolio" class="portfolio-full-description">

                <div class="fulldescription_title gallery-filters">
                    <h1>{{ $portfolio->title }}</h1>
                </div>

                <div class="portfolios hentry work group">
                    <div class="work-thumbnail">
                        <a class="thumb"><img src="{{ asset(config('settings.theme')) }}/images/projects/{{ $portfolio->image->max }}" alt="" title="" /></a>
                    </div>
                    <div class="work-description">
                        <p>{{ $portfolio->text }}</p>
                        <div class="clear"></div>
                        <div class="work-skillsdate">
                            <p class="skills"><span class="label">{{ Lang::get('ru.filter') }}:</span> {{ $portfolio->filter->title }}</p>
                            <p class="workdate"><span class="label">{{ Lang::get('ru.customer') }}:</span> {{ $portfolio->customer }}</p>
                            @if($portfolio->created_at)
                            <p class="workdate"><span class="label">{{ Lang::get('ru.year') }}:</span> {{ $portfolio->created_at->format('Y') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="clear"></div>

                @if(!$portfolios->isEmpty())

                <h3>{{ Lang::get('ru.other_projects') }}</h3>

                <div class="portfolio-full-description-related-projects">

                    @foreach($portfolios as $portfolio)

                    <div class="related_project">
                        <a class="related_proj related_img" href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}" title="{{ $portfolio->title }}"><img src="{{ asset(config('settings.theme')) }}/images/projects/{{ $portfolio->image->mini }}" alt="" title="" /></a>
                        <h4><a href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}">{{ $portfolio->title }}</a></h4>
                    </div>

                    @endforeach

                </div>

                @endif

            </div>

            @endif

            <div class="clear"></div>
        </div>
    </div>
</div>