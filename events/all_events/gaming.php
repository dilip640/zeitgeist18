<div class="content">
    <header class="codrops-header">
        <div class="codrops-links">
            <a class="codrops-icon codrops-icon--prev" href="https://tympanus.net/Development/ProximityFeedback/" title="Previous Demo"><svg class="icon icon--arrow">
                    <use xlink:href="#icon-arrow"></use>
                </svg></a>
            <a class="codrops-icon codrops-icon--drop" href="https://tympanus.net/codrops/?p=34897" title="Back to the article"><svg class="icon icon--drop">
                    <use xlink:href="#icon-drop"></use>
                </svg></a>
			<span class="goback" style="position:fixed; cursor:pointer; z-index:100;" onclick="location.href='index.html'">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="35px" height="35px" viewBox="-3 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                <style type="text/css">
                    .cd-nugget-info-arrow {
                        fill: #fff;
                    }
                </style>
                <polygon class="cd-nugget-info-arrow" points="15,7 4.4,7 8.4,3 7,1.6 0.6,8 0.6,8 0.6,8 7,14.4 8.4,13 4.4,9 15,9 "></polygon>
            </svg>
        </span>
        </div>
        <h1 class="codrops-header__title">GAMING EVENTS</h1>
        <a class="github" href="https://github.com/codrops/GridLayoutMotion/" title="Find this project on GitHub"><svg class="icon icon--github">
                <use xlink:href="#icon-github"></use>
            </svg></a>
    </header>
</div>
<div class="content">
    <div class="grid">
        <a class="grid__item" href="#preview-1">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img" src="img/cs_go.jpg" alt="Some image" />
                <h3 class="box__title"><span class="box__title-inner" data-hover="40K">40K</span></h3>
                <h4 class="box__text"><span class="box__text-inner">CS-Go</span></h4>
                <div class="box__deco">&#10014;</div>
                <p class="box__content">"Sometimes we go surfing when it's stormy weather"</p>
            </div>
        </a>
        <a class="grid__item" href="#preview-2">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img" src="img/dota.jpg" alt="Some image" />
                <h3 class="box__title"><span class="box__title-inner" data-hover="30K">30K</span></h3>
                <h4 class="box__text box__text--bottom box__text--right"><span class="box__text-inner box__text-inner--rotated3">Dota</span></h4>
            </div>
        </a>
        <a class="grid__item" href="#preview-3">
            <div class="box">
                <div class="box__shadow"></div>
                <img class="box__img" src="img/fifa.jpg" alt="Some image" />
                <h3 class="box__title box__title--straight box__title--left"><span class="box__title-inner" data-hover="10k">10k</span></h3>
                <h4 class="box__text box__text--bottom box__text--right"><span class="box__text-inner box__text-inner--rotated3">Fifa</span></h4>
                <div class="box__deco box__deco--top">&#10153;</div>
            </div>
        </a>
    </div>
</div>
<div class="overlay">
    <div class="overlay__reveal"></div>
    <div class="overlay__item" id="preview-1">
        <div class="box">
            <div class="box__shadow"></div>
            <img class="box__img box__img--original" src="img/cs_go.jpg" alt="Some image" />
            <h3 class="box__title"><span class="box__title-inner">40K</span></h3>
            <h4 class="box__text"><span class="box__text-inner">CS-Go</span></h4>
            <div class="box__deco">&#10014;</div>
        </div>
        <div class="overlay__content">
            <div class="myBtn">
                <a href="register.php?event=CS-GO" data-title="Register"></a>
            </div>
            <p>To be updated soon.</p>
        </div>
    </div>
    <div class="overlay__item" id="preview-2">
        <div class="box">
            <div class="box__shadow"></div>
            <img class="box__img box__img--original" src="img/dota.jpg" alt="Some image" />
            <h3 class="box__title"><span class="box__title-inner">30K</span></h3>
            <h4 class="box__text box__text--bottom box__text--right"><span class="box__text-inner box__text-inner--rotated3">Dota</span></h4>
        </div>
        <div class="overlay__content">
            <div class="myBtn">
                <a href="register.php?event=DOTA" data-title="Register"></a>
            </div>
            <p>To be updated soon.</p>
        </div>
    </div>
    <div class="overlay__item" id="preview-3">
        <div class="box">
            <div class="box__shadow"></div>
            <img class="box__img box__img--original" src="img/fifa.jpg" alt="Some image" />
            <h3 class="box__title box__title--straight box__title--left"><span class="box__title-inner">10</span></h3>
            <h4 class="box__text box__text--bottom box__text--right"><span class="box__text-inner box__text-inner--rotated3">Fifa</span></h4>
            <div class="box__deco box__deco--top">&#10153;</div>
        </div>
        <div class="overlay__content">
            <div class="myBtn">
                <a href="register.php?event=FIFA" data-title="Register"></a>
            </div>
            <p>To be updated soon.</p>
        </div>
    </div>
    <button class="overlay__close"><svg class="icon icon--cross">
            <use xlink:href="#icon-cross"></use>
        </svg></button>
</div>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/TweenMax.min.js"></script>
<script src="js/demo.js"></script>