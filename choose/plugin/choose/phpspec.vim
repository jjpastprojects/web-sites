function! RunOneFunctionWithPhpSpec()
   let l:winview = winsaveview()
   execute 'normal ?function'
   let command =  g:PhpSpecRun." ".bufname('%').":".line(".").'<cr>'
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction


function! RunOneFunctionWithPhpSpec2()
   let l:winview = winsaveview()
   let l:functionName = input('function name: ')
   let command =  g:PhpSpec.'   --filter "/::'.l:functionName.'.*(.*)/" <cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

"it get the name of function where I am insede
function! TestThisFunction()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let l:command =  ':!clear && '.g:PhpSpecPhar.'  --filter "/::'.@f.'.*(.*)/"' 
   execute l:command
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithPhpSpecWithCodeCoverage()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let command =  g:PhpSpec.'  --coverage-text --filter "/::'.@f.'.*(.*)/" %<cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithPhpSpec2WithCodeCoverage()
   let l:winview = winsaveview()
   let l:functionName = input('function name: ')
   let command =  g:PhpSpec.' --coverage-text --filter "/::'.l:functionName.'.*(.*)/" <cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction


"it get the name of function where I am insede
function! TestThisFunctionWithCodeCoverage()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let l:command =  ':!clear && '.g:PhpSpecPhar.'  --coverage-text --filter "/::'.@f.'.*(.*)/"' 
   execute l:command
   call winrestview(l:winview)
endfunction

