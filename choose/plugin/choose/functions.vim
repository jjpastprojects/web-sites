function! CreateFile()
    let name = input('Name: ','','file')
    let dir = name

    execute 'normal :!mkdir -p  '.dir.''
    execute 'normal :!rmdir   '.dir.''
    execute 'normal :tabnew '.dir.''

endfunction 

function! Choose(commands)

    let keys = sort(keys(a:commands))

    for key in keys
            echo key 
    endfor

    let choix = input('choose: ')

    if choix != ''
        for key in keys
            if key =~ '^'.choix
                execute a:commands[key]
            endif
        endfor
    endif

    echo '  '

endfunction

function! FacadeLookup()
    let facade = input('Facade Name: ')
    let classes = {
\       'Form': 'Html/FormBuilder.php',
\       'Html': 'Html/HtmlBuilder.php',
\       'File': 'Filesystem/Filesystem.php',
\       'Eloquent': 'Database/Eloquent/Model.php'
\   }
 
    execute ":edit vendor/laravel/framework/src/Illuminate/" . classes[facade]
endfunction

function! Class()
    let name = input('Class name? ')
    let namespace = input('Any Namespace? ')

    if strlen(namespace)
        exec 'normal i<?php namespace '.namespace.';'
    else
        exec 'normal i<?php'
    endif

    exec 'normal iclass '.name.'{}'

    exec 'normal i   public function  __construct(){ }0dw'
endfunction

" Add a new dependency to a PHP class
function! AddDependency()
    let dependency = input('Var Name: ')
    let namespace = input('Class Path: ') 
    if strlen(namespace)
        let segments = split(namespace, '\')
        let typehint = segments[-1]
    endif
    if strlen(namespace)
        exec 'normal gg/__construct/)i, ' . typehint . ' $' . dependency . ''
    else
        exec 'normal gg/__construct/)i, $' . dependency . ''
    endif
    exec 'normal /}O$this->a' . dependency . ' = $' . dependency . ';'
    exec 'normal ?{kOprotected $' . dependency . ';'
    if strlen(namespace)
        exec 'normal ?class?\v(use|namespace|php)ouse ' . namespace . ';'
    endif
    " Remove opening comma if there is only one dependency
    exec 'normal :%s/\v(\(, |\()/\(/'
endfunction


function! Laravel()

    cabbrev gm !make artisan ART=generate:model
    cabbrev gc !make artisan ART=generate:controller
    cabbrev mig !make artisan ART=migrate
    cabbrev gmig !make artisan ART=generate:migration 
    nnoremap ng :!make artisan ART=

    nnoremap <leader>lf :call FacadeLookup()<cr>
    nnoremap <leader>c :call Class()<cr>
    nnoremap <leader>v :call AddDependency()<cr>

endfunction

function! Laravel4()
    call Laravel()
    abbrev omig tabnew app/database/migrations/
    abbrev oc tabnew app/controllers/
    nnoremap ;r :e app/routes.php<cr>
endfunction

function! Laravel5()
    call Laravel()
    abbrev omig tabnew database/migrations/
    abbrev oc tabnew app/Http/Controllers/
endfunction

function! GetTester()
   let file = GetTestYmlFile()
   return GetYmlValue(file, 'test')
endfunction

function! GetTestingList()
    let tester = GetTester()
    if tester == 'codeception'
        return g:CodeceptionList
    elseif tester == 'phpunit'
        return g:PhpUnitList
    elseif tester == 'phpspec'
        return g:PhpSpecList
    endif
endfunction

function! RefreshThenChoose()
    source ~/.vim/bundle/choose/plugin/choose/config.vim
    call Choose(GetTestingList())
endfunction

function! MyVimRc()
    call Laravel()
    abbrev pft PHPUnit_Framework_TestCase
    nnoremap f; :call CreateFile()<cr>
    nnoremap ;c :call Class()<cr>
    nnoremap nf :call RefreshThenChoose()<cr>
    nnoremap  nd :call Choose(g:commands)<cr>
endfunction

function! SetArabic()
    set keymap=arabic
    set encoding=utf-8
    set arabicshape
    set arabic
    set rl
endfunction

" Rename.vim  -  Rename a buffer within Vim and on the disk
"
" Copyright June 2007-2011 by Christian J. Robinson <heptite@gmail.com>
"
" Distributed under the terms of the Vim license.  See ":help license".
"
" Usage:
"
" :Rename[!] {newname}

command! -nargs=* -complete=file -bang Rename call Rename(<q-args>, '<bang>')

function! Rename(name, bang)
	let l:name    = a:name
	let l:oldfile = expand('%:p')

	if bufexists(fnamemodify(l:name, ':p'))
		if (a:bang ==# '!')
			silent exe bufnr(fnamemodify(l:name, ':p')) . 'bwipe!'
		else
			echohl ErrorMsg
			echomsg 'A buffer with that name already exists (use ! to override).'
			echohl None
			return 0
		endif
	endif

	let l:status = 1

	let v:errmsg = ''
	silent! exe 'saveas' . a:bang . ' ' . l:name

	if v:errmsg =~# '^$\|^E329'
		let l:lastbufnr = bufnr('$')

		if expand('%:p') !=# l:oldfile && filewritable(expand('%:p'))
			if fnamemodify(bufname(l:lastbufnr), ':p') ==# l:oldfile
				silent exe l:lastbufnr . 'bwipe!'
			else
				echohl ErrorMsg
				echomsg 'Could not wipe out the old buffer for some reason.'
				echohl None
				let l:status = 0
			endif

			if delete(l:oldfile) != 0
				echohl ErrorMsg
				echomsg 'Could not delete the old file: ' . l:oldfile
				echohl None
				let l:status = 0
			endif
		else
			echohl ErrorMsg
			echomsg 'Rename failed for some reason.'
			echohl None
			let l:status = 0
		endif
	else
		echoerr v:errmsg
		let l:status = 0
	endif

	return l:status
endfunction

func! Eatchar(pat)
    let c = nr2char(getchar(0))
    return (c =~ a:pat) ? '' : c
endfunc

function! LessMode()
  if g:lessmode == 0
    let g:lessmode = 1
    let onoff = 'on'
    " Scroll half a page down
    noremap <script> d <C-D>
    " Scroll one line down
    noremap <script> j <C-E>
    " Scroll half a page up
    noremap <script> u <C-U>
    " Scroll one line up
    noremap <script> k <C-Y>
  else
    let g:lessmode = 0
    let onoff = 'off'
    unmap d
    unmap j
    unmap u
    unmap k
  endif
  echohl Label | echo "Less mode" onoff | echohl None
endfunction

let g:lessmode = 0
nnoremap <F5> :call LessMode()<CR>
inoremap <F5> <Esc>:call LessMode()<CR>

function! SetTags()

    let files = {
                \'m': 'min',
                \'v' : 'vendor',
                \'n': 'node'
    \}


    let keys = sort(keys(files))

    for key in keys
            echo key.' => '.files[key]
    endfor

    let choix = input('choose: ')

    if choix != ''
        for key in keys
            if key =~ '^'.choix
                execute  ':!ln -fs ./.tags/'.files[key].'   ./tags'
            endif
        endfor
    endif

    echo '  '

endfunc
nnoremap tc :call SetTags()<CR>
nnoremap tt :tag<space>
nnoremap tn :tn<cr>
nnoremap tp :tp<cr>
