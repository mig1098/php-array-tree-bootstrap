<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="mig.inc" />

	<title>tree</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>

    <style type="text/css">
    #mg-multisidetabs .list-group-item:first-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    #mg-multisidetabs .list-group-item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    #mg-multisidetabs .list-group{
      margin-bottom:0;
    }
    .slide-container{
      overflow:hidden;
    }
    #mg-multisidetabs .list-sub{
      display:none;
      border:0;
    }
    #mg-multisidetabs .panel{
      margin-bottom:0;
    }
    #mg-multisidetabs .panel-body{
      padding:1px 0;
    }
    .mg-icon{
      font-size:10px;
      line-height: 20px;
    }
    .mg-space-1{
        margin-left:10px;
    }
    .mg-space-2{
        margin-left:20px;
    }
    .mg-space-3{
        margin-left:30px;
    }
    </style>
<div class="container">
<div class="panel panel-default">
<div class="panel-body">

<?php
function buildtree(&$result,$dropdown,$space='',$callback=null){
    $drop = false;
    if(!is_array($dropdown) || count($dropdown) < 1 ){ return false; }
    $i = 0;
    $space .= $space;
    while($i < count($dropdown)){
        $key        = key($dropdown);
        $item       = ( is_numeric($key) ? $dropdown[$key] : $key );
        $childexist = !empty($dropdown[$item]) && is_array($dropdown[$item]);
        if(is_callable($callback)){
            $result .= $callback($item,$childexist,$space);
        }
        
        if($childexist){//exist child array
            $result .= '<div class="panel list-sub">
                        <div class="panel-body">
                          <div class="list-group">';
        }
        if(is_array($dropdown[$key])){
            buildtree($result,$dropdown[$key],$space,$callback);
        }
        if($childexist){//exist child array
            $result .= '</div>
                     </div>
                  </div>';
        }
        next($dropdown);
        $i++;
    }
} 
$dropdowns = array(
    'category' => array(
        'men'=>array('departments','designers','surf by price','surf by size'=>array('one','two'=>array('one','two','three','four'),'three','four')),
        'women'=>array('departments','designers','surf by price','surf by size'),
        'handbags'=>array('styles','designers','surf by price','surf by material')
    ),
    'condition' => array(),
    'size'      => array(),
    'Brand'     => array(),
    'Pricing'   => array()
);
$result = '';
$space = '&nbsp;';
buildtree($result,$dropdowns,$space,function($item,$childexist,$space){
    return '<a href="#" class="list-group-item"><span>'.$space.$item.'</span>'.
    ( $childexist ? '<span class="glyphicon glyphicon-menu-right mg-icon pull-right"></span>' : '' ).
    '</a>';
});
?>
<div class="row">
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
 <div class="panel">
    <div class="panel-body">
      <div class="slide-container">
        <div class="list-group" id="mg-multisidetabs">
            <?php echo $result; ?>
        </div><!-- ./ end list-group -->
      </div><!-- ./ end slide-container -->
    </div><!-- ./ end panel-body -->
  </div><!-- ./ end panel panel-default-->
</div><!-- ./ endcol-lg-6 col-lg-offset-3 -->
</div><!-- ./ end row -->


</div>
</div>
</div>
          <script type="text/javascript">
          $(document).ready(function(){
            
            var multisidetabs=(function(){
       	      var opt,parentid,
              vars={
                listsub:'.list-sub',
                showclass:'mg-show'
              },
              test=function(){
                console.log(parentid);
              },
              events = function(){
                $(parentid).find('a').on('click',function(ev){
                  ev.preventDefault();
                  var atag = $(this), childsub = atag.next(vars.listsub);
                  //console.log(atag.text());
                  if(childsub && opt.multipletab == true){
                    if(childsub.hasClass(vars.showclass)){
                      childsub.removeClass(vars.showclass).slideUp(500);
                    }else{
                      childsub.addClass(vars.showclass).slideDown(500);
                    }
                  }
                  if(childsub && opt.multipletab == false){
                   childsub.siblings(vars.listsub).removeClass(vars.showclass).slideUp(500);
                   if(childsub.hasClass(vars.showclass)){
                     childsub.removeClass(vars.showclass).slideUp(500);
                   }else{
                     childsub.addClass(vars.showclass).slideDown(500);
                   }
                  }
                });
              },
              init=function(options){//initials
                if(options){
                  opt = options;
                  parentid = '#'+options.id;
                  //test();
              	  events();
                }else{ alert('no options'); }
              }
              
            	return {init:init};
            })();
            
            multisidetabs.init({
            	"id":"mg-multisidetabs",
              "multipletab":false
            });
            
            var mgproduct={
    
            };
            
          })
          </script>
</body>
</html>
