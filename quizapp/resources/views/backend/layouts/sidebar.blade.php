<div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="{{url('/')}}"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                                <li><a href="{{route('quiz.create')}}"><i class="menu-icon icon-bullhorn"></i> Create Quiz </a>
                                </li>
                                <li><a href="{{route('quiz.index')}}"><i class="menu-icon icon-inbox"></i>View Quiz <b class="label green pull-right">
                                    </b> </a></li>
                                
                            </ul>

                            <ul class="widget widget-menu unstyled">
                                
                                <li><a href="{{route('question.create')}}"><i class="menu-icon icon-bullhorn"></i> Create Question </a>
                                </li>
                                <li><a href="{{route('question.index')}}"><i class="menu-icon icon-inbox"></i>View Question <b class="label green pull-right">
                                    </b> </a></li>
                                
                            </ul>
                            <!--/.widget-nav-->
                             </ul>
                        
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="icon-inbox"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->