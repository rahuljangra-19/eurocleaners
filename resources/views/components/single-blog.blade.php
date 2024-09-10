@inject('carbon', 'Carbon\Carbon')
<section class="wpo-blog-single-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-lg-8 col-12">
                <div class="wpo-blog-content">
                    <div class="post format-standard-image">
                        <div class="entry-media">

                            @php
                            $singleBlogImagePath = isset($post['image']) ? 'storage/' . $post['image'] : null;
                            @endphp

                            @if ($singleBlogImagePath && File::exists(public_path($singleBlogImagePath)))
                            <img src="{{ asset($singleBlogImagePath) }}" alt="">
                            @else
                            <img src="{{ asset('assets/images/blog/img-4.jpg') }}" alt>
                            @endif

                        </div> 
                        <div class="entry-meta">
                            <ul>
                                @isset($post['author_details']['name'])
                                <li><i class="fi flaticon-user"></i> By <a href="#">{{ $post['author_details']['name'] ?? '' }}</a> </li>
                                @endisset
                                {{-- <li><i class="fi flaticon-comment-white-oval-bubble"></i> Comments 35 </li> --}}
                                <li><i class="fi flaticon-calendar"></i> {{ $carbon->parse($post['created_at'])->format('d M, Y') }}</li>
                            </ul>
                        </div>
                        <h2>{{ $post['title'] }}</h2>
                        @isset($post['desc_first'])
                        <p>{!! $post['desc_first'] !!}</p>

                        @endisset
                        @isset($post['thought'])
                        <blockquote>{{ $post['thought'] }} </blockquote>

                        @endisset

                        @isset($post['desc_second'])
                        <p>{!! $post['desc_second'] !!}</p>

                        @endisset

                        <div class="gallery">
                            <div>
                                <img src="assets/images/blog/2.jpg" alt="">
                            </div>
                            <div>
                                <img src="assets/images/blog/3.jpg" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="tag-share clearfix">
                        <div class="tag">
                            <span>Share: </span>
                            <ul>
                                <li><a href="#">Construction</a></li>
                                <li><a href="#">Window</a></li>
                                <li><a href="#">Kitchen</a></li>
                            </ul>
                        </div>
                    </div> <!-- end tag-share -->
                    {{-- <div class="tag-share-s2 clearfix">
                        <div class="tag">
                            <span>Share: </span>
                            <ul>
                                <li><a href="#">facebook</a></li>
                                <li><a href="#">twitter</a></li>
                                <li><a href="#">linkedin</a></li>
                                <li><a href="#">pinterest</a></li>
                            </ul>
                        </div>
                    </div> <!-- end tag-share --> --}}

                    <div class="author-box">
                        <div class="author-avatar">
                            <a href="#">
                                @php
                                $singleBlogAuthorPath = isset($post['author_details']['image']) ? 'storage/' . $post['author_details']['image'] : null;
                                @endphp

                                @if ($singleBlogAuthorPath && File::exists(public_path($singleBlogAuthorPath)))
                                <img src="{{ asset($singleBlogAuthorPath) }}" class="img-projects" alt="">
                                @else
                                <img src="{{ asset('assets/images/blog-details/author.jpg') }}" class="img-projects">
                                @endif

                            </a>
                        </div>
                        <div class="author-content">
                            @isset($post['author_details']['name'])
                            <a href="#" class="author-name">Author: {{ $post['author_details']['name'] ?? '' }}</a>
                            @endisset
                            @isset($post['author_details']['desc'])
                            <p>{{ $post['author_details']['desc'] ?? '' }}
                                @endisset
                                <div class="socials">
                                    <ul class="social-link">

                                        @isset($post['author_details']['google_link'])
                                        <li><a target="_blank" href="{{ $post['author_details']['google_link'] }}"><i class="ti-google"></i></a></li>

                                        @endisset
                                        @isset($post['author_details']['fb_link'])
                                        <li><a target="_blank" href="{{ $post['author_details']['fb_link'] }}"><i class="ti-facebook"></i></a></li>

                                        @endisset
                                        @isset($post['author_details']['pine_link'])
                                        <li><a target="_blank" href="{{ $post['author_details']['pine_link'] }}"><i class="ti-pinterest"></i></a></li>

                                        @endisset

                                        @isset($post['author_details']['insta_link'])
                                        <li><a target="_blank" href="{{ $post['author_details']['insta_link'] }}"><i class="ti-instagram"></i></a></li>
                                        @endisset
                                        @isset($post['author_details']['linkedin_link'])
                                        <li><a target="_blank" href="{{ $post['author_details']['linkedin_link'] }}"><i class="ti-linkedin"></i></a></li>
                                        @endisset

                                        @isset($post['author_details']['twitter_link'])
                                        <li><a target="_blank" href="{{ $post['author_details']['twitter_link'] }}"><i class="ti-twitter-alt"></i></a></li>

                                        @endisset
                                    </ul>
                                </div>
                        </div>
                    </div> <!-- end author-box -->

                    <div class="more-posts">
                        <div class="previous-post">
                            @isset($post['previous'])

                            <a href="{{ URL($post['previous']['slug']) }}">
                                <span class="post-control-link">Previous Post</span>
                                <span class="post-name">{{ $post['previous']['title'] }}</span>
                            </a>
                            @endisset
                        </div>

                        <div class="next-post">
                            @isset($post['next'])
                            <a href="{{ URL($post['next']['slug']) }}">
                                <span class="post-control-link">Next Post</span>
                                <span class="post-name">{{ $post['next']['title'] }}</span>
                            </a>
                            @endisset
                        </div>
                    </div>

                    {{-- <div class="comments-area">
                        <div class="comments-section">
                            <h3 class="comments-title">5 Comments</h3>
                            <ol class="comments">
                                <li class="comment even thread-even depth-1" id="comment-1">
                                    <div id="div-comment-1">
                                        <div class="comment-theme">
                                            <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-1.jpg" alt></div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="comments-meta">
                                                    <h4>Robert Sonny <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                </div>
                                                <div class="comment-area">
                                                    <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                    <div class="comments-reply">
                                                        <a class="comment-reply-link" href="#"><span>Reply</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="children">
                                        <li class="comment">
                                            <div>
                                                <div class="comment-theme">
                                                    <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-2.jpg" alt></div>
                                                </div>
                                                <div class="comment-main-area">
                                                    <div class="comment-wrapper">
                                                        <div class="comments-meta">
                                                            <h4>John Abraham <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                        </div>
                                                        <div class="comment-area">
                                                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                            <div class="comments-reply">
                                                                <a class="comment-reply-link" href="#"><span>Reply</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul>
                                                <li class="comment">
                                                    <div>
                                                        <div class="comment-theme">
                                                            <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-3.jpg" alt></div>
                                                        </div>
                                                        <div class="comment-main-area">
                                                            <div class="comment-wrapper">
                                                                <div class="comments-meta">
                                                                    <h4>Robert Sonny <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                                </div>
                                                                <div class="comment-area">
                                                                    <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                                    <div class="comments-reply">
                                                                        <a class="comment-reply-link" href="#"><span>Reply</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="comment">
                                    <div>
                                        <div class="comment-theme">
                                            <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-1.jpg" alt></div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="comments-meta">
                                                    <h4>John Abraham <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                </div>
                                                <div class="comment-area">
                                                    <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                    <div class="comments-reply">
                                                        <a class="comment-reply-link" href="#"><span>Reply</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div> <!-- end comments-section -->

                        <div class="comment-respond">
                            <h3 class="comment-reply-title">Leave a reply</h3>
                            <form class="comment-form">
                                <div class="form-inputs">
                                    <input placeholder="Name" type="text">
                                    <input placeholder="Email" type="email">
                                    <input placeholder="Website" type="url">
                                </div>
                                <div class="form-textarea">
                                    <textarea id="comment" placeholder="Write Your Comments..."></textarea>
                                </div>
                                <div class="form-submit">
                                    <input id="submit" value="Post Comment" type="submit">
                                </div>
                            </form>
                        </div>
                    </div> <!-- end comments-area --> --}}
                </div>
            </div>
            <div class="col col-lg-4 col-12">
                <x-blog-right-bar :postId="$post['id']" />
            </div>
        </div>
    </div> <!-- end container -->
</section>
