Hello <i>{{ $body->receiver }}</i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>
 
<p><u>Body object values:</u></p>
 
<div>
<p><b>Body One:</b>&nbsp;{{ $body->body_one }}</p>
<p><b>Body Two:</b>&nbsp;{{ $body->body_two }}</p>
</div>
 
<p><u>Values passed by With method:</u></p>
 
<div>
<p><b>testVarOne:</b>&nbsp;{{ $testVarOne }}</p>
<p><b>testVarTwo:</b>&nbsp;{{ $testVarTwo }}</p>
</div>
 
Thank You,
<br/>
<i>{{ $body->sender }}</i>