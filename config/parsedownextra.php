<?php

return [
	'purifier'	=> [
		'enabled'	=> true,
		'settings'	=> [
			// Do not edit or remove
			'global'	=> [
				'Cache.SerializerPath'	=> storage_path('app/htmlpurifier')
			],

			// Default settings
			'default'	=> [
				'Attr.EnableID'				=> true,

				'AutoFormat.RemoveEmpty'	=> true,

				'HTML.Allowed'				=> implode(',', [
					'*[class]', '*[id]', 'h1', 'h2',
					'h3', 'h4', 'h5', 'h6',
					'div', 'b', 'strong', 'i',
					'em', 'a[href|title]', 'ul', 'ol',
					'li', 'p', 'br', 'span',
					'img[width|height|alt|src]', 'code', 'pre', 'hr',
					'sup', 'table', 'thead', 'tbody',
					'tr', 'th', 'td', 'th[style]', 'td[style]'
				]),
				'HTML.Nofollow'				=> true,
				'HTML.TargetBlank'			=> true,

				'Output.SortAttr'			=> true
			]
		]
	]
];
