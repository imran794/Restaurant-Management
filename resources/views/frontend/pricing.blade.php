  <section id="pricing" class="pricing">
            <div id="w">
                <div class="pricing-filter">
                    <div class="pricing-filter-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="section-header">
                                        <h2 class="pricing-title">Menu List</h2>
                                        <ul id="filter-list" class="clearfix">
                                            <li class="filter" data-filter="all">All</li>
                                            @foreach ($categories as $category)
                                            <li class="filter" data-filter="#{{ $category->slug }}">{{ $category->name }}
                                            </li>
                                            @endforeach
                                            {{-- <li class="filter" data-filter=".special">Special</li>
                                            <li class="filter" data-filter=".desert">Desert</li>
                                            <li class="filter" data-filter=".dinner">Dinner</li> --}}
                                        </ul><!-- @end #filter-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">  
                        <div class="col-md-10 col-md-offset-1">
                            <ul id="menu-pricing" class="menu-price">
                                @foreach ($items as $item)
                                <li class="item" id="{{ $item->category->slug }}">

                                    <a href="#">
                                        <img src="{{ Storage::disk('public')->url('item_image/'.$item->image) }}" class="img-responsive" alt="Food" >
                                        <div class="menu-desc text-center">
                                            <span>
                                                <h3>{{ $item->name }}</h3>
                                                {{ $item->description }}
                                            </span>
                                        </div>
                                    </a>
                                        
                                    <h2 class="white">{{ $item->price }}Tk</h2>
                                </li>
                            @endforeach
                            </ul>

                        </div>   
                    </div>
                </div>

            </div> 
        </section>