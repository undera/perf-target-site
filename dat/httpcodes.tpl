<h1>Demo for HTTP Codes</h1>
{if $code}
    <h2>Simulated response: {$code} {$codes.$code}</h2>
{/if}
<h2>List of codes (<a href="/http/random">random</a>):</h2>
<ul>
    {foreach $codes as $code=>$descr}
        <li><a href="/http/{$code}">{$code} {$descr}</a></li>
    {/foreach}
</ul>
