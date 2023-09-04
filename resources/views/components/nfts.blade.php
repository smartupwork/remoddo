<ul class="cards-list">
    @foreach($nfts as $nft)
        <li class="card-item">
            <div class="br-30 mb-15 bg-dog-1 card-dog-img" style="background-color:{{$nft->background_color}}">
                <img class="img-dog" src="{{$nft->image}}" alt="img">
            </div>
            <a href="{{route('nfts.show', $nft->token_id)}}">
                <h3 class="card-name mb-2">{{$nft->name}}</h3>
            </a>
            <span class="card-number">{{$nft->token_id}}</span>
            <div class="properties-group">
                <div class="properties mr-15">
                    <span class="mr-8 d-flex">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.4565 7.97344C21.2899 7.90791 21.1124 7.8745 20.9333 7.875H20.9146C19.9691 7.88906 18.9088 8.77453 18.3524 10.1137C17.6854 11.7159 17.9924 13.3552 19.0433 13.7766C19.2098 13.8421 19.3871 13.8755 19.566 13.875C20.5162 13.875 21.591 12.9844 22.1521 11.6362C22.8144 10.0341 22.5027 8.39484 21.4565 7.97344ZM15.3562 14.2256C14.053 12.0633 13.4905 11.25 11.9999 11.25C10.5093 11.25 9.9421 12.0684 8.63898 14.2256C7.52335 16.0706 5.26866 16.2244 4.70616 17.7914C4.59205 18.0784 4.53474 18.3849 4.53741 18.6937C4.53741 19.9683 5.51241 21 6.71241 21C8.20304 21 10.2327 19.8098 12.0046 19.8098C13.7765 19.8098 15.7968 21 17.2874 21C18.4874 21 19.4577 19.9687 19.4577 18.6937C19.4588 18.3846 19.3999 18.0781 19.2843 17.7914C18.7218 16.2187 16.4718 16.0706 15.3562 14.2256ZM9.02382 9.1875C9.08658 9.18755 9.14926 9.18285 9.21132 9.17344C10.2993 9.01547 10.9785 7.50797 10.7319 5.80547C10.4999 4.20047 9.52585 3 8.50726 3C8.44449 2.99995 8.38181 3.00465 8.31976 3.01406C7.23179 3.17203 6.55257 4.67953 6.79913 6.38203C7.03116 7.98234 8.00522 9.1875 9.02382 9.1875ZM17.1993 6.38203C17.4458 4.67953 16.7666 3.17203 15.6787 3.01406C15.6166 3.00465 15.5539 2.99995 15.4912 3C14.4726 3 13.5004 4.20047 13.2679 5.80547C13.0213 7.50797 13.7005 9.01547 14.7885 9.17344C14.8506 9.18285 14.9132 9.18755 14.976 9.1875C15.9946 9.1875 16.9687 7.98234 17.1993 6.38203ZM4.95788 13.7766C6.00741 13.3547 6.31398 11.7141 5.64788 10.1137C5.08726 8.76562 4.01335 7.875 3.0646 7.875C2.88573 7.87451 2.70838 7.90791 2.54195 7.97344C1.49241 8.39531 1.18585 10.0359 1.85195 11.6362C2.41257 12.9844 3.48648 13.875 4.43523 13.875C4.6141 13.8755 4.79144 13.8421 4.95788 13.7766Z" stroke="#AFAFAF" stroke-width="1.5" stroke-miterlimit="10"></path>
                        </svg>
                    </span>
                    <span>?gen</span>
                </div>
                <div class="properties">
                    <span class="mr-8 d-flex">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.066 12.1192H11.4141" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <circle cx="12.0174" cy="11.5167" r="9.00375" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                            <path d="M11.4143 12.1192V6.51457" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <span>Cooldown (?m)</span>
                </div>
            </div>
            <a href="#" class="btn btn-warning btn-sm ">
                <span class="opacity-05 mr-5">Buy </span> <span>{{ $nft->price }} ETH</span>
            </a>
        </li>
    @endforeach
</ul>

{{$nfts->links()}}
