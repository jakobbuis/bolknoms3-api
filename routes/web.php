<?php

Route::get('/', function(){ return redirect('/docs/introduction'); });

Route::get('/docs/{page?}', 'DocsController@page');
