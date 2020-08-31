<li class="comment-item" id="comment_{{ $item['id'] }}">
            <div class="comment__author author vcard inline-items">
                <img src="{{ asset($item->authorable['avatar']) }}" alt="{{ $item->authorable['full_name'] }}">
                <div class="author-date">
                    <a class="h6 post__author-name fn" href="{{ route('user.show',['user' => $item->authorable['id']]) }}">
                        {{ $item->authorable['full_name'] }}
                    </a>
                    <div class="comment__date">
                        <time class="published" datetime="{{ $item['created_at'] }}">
                            {{ $item['created_at'] }}
                        </time>
                    </div>
                </div>
                {{-- @can('update', $item) --}}
                    <div class="more">
                        <svg class="olymp-three-dots-icon">
                            <use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use>
                        </svg>
                        <ul class="more-dropdown">
                            <li>
                                <a href="#" class="edit_comment" data-id="{{ $item['id'] }}">Редактировать коммент</a>
                            </li>
                            <li>
                            <a href="#" class="delete_comment" data-id="{{ $item['id'] }}" data-feed="{{ $feed }}">Удалить коммент</a>
                            </li>
                        </ul>
                    </div>
                {{-- @endcan --}}
            </div>
            <p class="can_edit">{{ $item['text'] }}</p>
            <a href="#" id="like_comment_{{ $item['id'] }}" data-like_id="{{ $item->likes->where('authorable_id', auth()->user()->id)->where('authorable_type', 'App\Models\User')->isNotEmpty() ? $item->likes->where('authorable_id', auth()->user()->id)->where('authorable_type', 'App\Models\User')->first()->id : 0 }}" class="post-add-icon inline-items can_like {{ $item->likes->where('authorable_id', auth()->user()->id)->where('authorable_type', 'App\Models\User')->isNotEmpty() ? 'like_it' : ''}}" onclick="event.preventDefault(); likeIt({{ $item['id'] }}, 'comment');">
                <form  method="POST" id="form_like_comment_{{ $item['id'] }}">
                    @csrf
                    <input type="hidden" name="likeable_type" value="App\Models\Comment">
                    <input type="hidden" name="likeable_id" value="{{ $item['id'] }}">
                    <input type="hidden" name="authorable_type" value="App\Models\User">
                    <input type="hidden" name="authorable_id" value="{{ $comment_author->id }}">
                    <input type="hidden" name="feed" value="{{ $feed }}">
                </form>
                <svg class="olymp-heart-icon">
                    <use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-heart-icon') }}"></use>
                </svg>
                <span>{{ count($item->likes) }}</span>
            </a>
            <a href="#" class="reply">Ответить</a>
        </li>
