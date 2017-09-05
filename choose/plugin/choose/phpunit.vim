function! RunOneFunctionWithPhpUnit()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let command =  g:PhpUnit.'  '.expand('%:p').' --filter "'.@f.'$" \| grep "Caused by" -A 1<cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithPhpUnitFull()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let command =  g:PhpUnit.' '.expand('%:p').'  --filter "'.@f.'$"<cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithPhpUnit2()
   let l:winview = winsaveview()
   let l:functionName = input('function name: ')
   let command =  g:PhpUnit.'   --filter "/::'.l:functionName.'.*(.*)/" <cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

"it get the name of function where I am insede
function! TestThisFunction()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let l:command =  ':!clear && '.g:PhpUnitPhar.'  --filter "/::'.@f.'.*(.*)/"' 
   execute l:command
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithPhpUnitWithCodeCoverage()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let command =  g:PhpUnit.'  --coverage-text --filter "/::'.@f.'.*(.*)/" %<cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithPhpUnit2WithCodeCoverage()
   let l:winview = winsaveview()
   let l:functionName = input('function name: ')
   let command =  g:PhpUnit.' --coverage-text --filter "/::'.l:functionName.'.*(.*)/" <cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction


"it get the name of function where I am insede
function! TestThisFunctionWithCodeCoverage()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let l:command =  ':!clear && '.g:PhpUnitPhar.'  --coverage-text --filter "/::'.@f.'.*(.*)/"' 
   execute l:command
   call winrestview(l:winview)
endfunction

