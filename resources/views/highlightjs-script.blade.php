@if (config('parsedownextra.highlightjs.enabled'))
	@if (config('parsedownextra.highlightjs.settings.cdn') === 'cdnjs')
		<script src="{{{ sprintf('https://cdnjs.cloudflare.com/ajax/libs/highlight.js/%s/highlight.min.js', config('parsedownextra.highlightjs.settings.version')) }}}"></script>
	@elseif (config('parsedownextra.highlightjs.settings.cdn') === 'jsdelivr')
		<script src="{{{ sprintf('https://cdn.jsdelivr.net/highlight.js/%s/highlight.min.js', config('parsedownextra.highlightjs.settings.version')) }}}"></script>
	@endif
@endif