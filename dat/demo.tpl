<!DOCTYPE html>
{assign var=i value='!i'}{assign var=a value='!a'}{assign var=p value='!p'}{assign var=c value='!c'}
{URL->getFullCount assign=urlFullCount}
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {PWE->getCurrentModuleInstance assign="module"}
        {if $module|is_a:'PWE\Modules\TitleGenerator'}
            {$module->generateTitle() assign="title"}
            {$title|default:$node.$i.title}
        {else}
            {$node.$i.title|default:$node.$a.link}
        {/if}
    </title>

    <!-- Bootstrap -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta name="keywords" content="{$node.$i.keywords|default:$node.$i.keywords}"/>
    <meta name="description" content="{$node.$i.description|default:$node.$i.description}"/>
    <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {if $smarty.server.SERVER_ADDR==$smarty.server.REMOTE_ADDR}
        <style type='text/css'>
            {include file='../img/demo.css'}
        </style>
    {else}
        <link rel="stylesheet" href="/img/demo.css"/>
    {/if}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Demo Websites</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {PWE->getStructLevel level=1 assign=level1}
            {if $level1}
                <ul class="nav navbar-nav">
                    {math assign=upper_repeats equation='x-1' x=$urlFullCount}
                    {foreach $level1 as $item1}
                        {if $item1.$a.menu}
                            {if $item1.selected}
                                <li class="active">
                                    <a href="#">{$item1.$a.title|default:$item1.$a.link}</a>
                                </li>
                            {else}
                                <li>
                                    <a href="{'../'|str_repeat:$upper_repeats}{$item1.$a.link}">{$item1.$a.title|default:$item1.$a.link}</a>
                                </li>
                            {/if}
                        {/if}
                    {/foreach}
                </ul>
            {/if}
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container">
    {PWE->getContent}
</div>


<footer>
    <div class="container">
        <hr/>
    </div>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</footer>

</body>
</html>

