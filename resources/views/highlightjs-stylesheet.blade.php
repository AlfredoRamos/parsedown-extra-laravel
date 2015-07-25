@if (config('parsedownextra.highlightjs.enabled'))
	@if (config('parsedownextra.highlightjs.settings.cdn') === 'cdnjs')
		<link media="all" rel="stylesheet" href="{{{ vsprintf('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/%s/styles/%s.min.css', [config('parsedownextra.highlightjs.settings.version'), config('parsedownextra.highlightjs.settings.style')]) }}}" />
	@elseif (config('parsedownextra.highlightjs.settings.cdn') === 'jsdelivr')
		<link media="all" rel="stylesheet" href="{{{ vsprintf('https://cdn.jsdelivr.net/highlight.js/%s/styles/%s.min.css', [config('parsedownextra.highlightjs.settings.version'), config('parsedownextra.highlightjs.settings.style')]) }}}" />
	@endif
@endif