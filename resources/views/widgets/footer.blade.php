<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-4">
                <div class="tab">
                    <ul>
                        <li>最新留言人</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tab">
                    <ul>
                        <li>标签列表</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>精选文章</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="fixedTools" class="hidden-xs hidden-sm hidden" style="border: none">
    <a id="backtop" class="border-bottom elevator">
        <i class="fa fa-angle-up"></i>
        <span>回到顶部</span>
    </a>
</div>

<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="navbar-inner navbar-content-center">
        <div class="text-muted credit" style="padding: 14px;">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>&copy; 2017-2018 <a href="http://blog.ifanatic.cn">爱狂热</a></strong> xiaoHu版权所有.
            </div>
        </div>
    </div>
</nav>

<script>
    var bLazy = new Blazy({
        // Options
    });
    $(document).ready(function() {
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
    (function(){
        var typing = $('#site-description');
        typing.typed(
            {
                replaceBaseText: true,
                strings: [
                    "For Laravel Artist"
                ],
                showCursor: false,
                typeSpeed: 80,
                backSpeed: 80,
                backDelay: 400
            }
        );
        $('#backtop').on('click',function() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });
        $(document).scroll(function(){$(this).scrollTop()>720?$("#fixedTools").removeClass("hidden"):$("#fixedTools").addClass("hidden")});
        $('.Article-List.Article-Post p:has(img)').addClass('Post--image');
    })();
</script>

