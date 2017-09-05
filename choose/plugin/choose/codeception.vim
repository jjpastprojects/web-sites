function! RunOneFunctionWithCodeception()
   let l:winview = winsaveview()
   execute 'normal ?public functionwwvwh"fy'
   let l:command =  g:CodeceptionRun.g:FileRelativePathToComposer.':'.@f.'<cr>'
   execute 'normal '.l:command.''
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithCodeception2()
   let l:winview = winsaveview()
   let l:functionName = input('function name: ')
   let command =  g:CodeceptionRun.'   --filter "/::'.l:functionName.'.*(.*)/" <cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

"it get the name of function where I am insede
function! TestThisFunction()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let l:command =  ':!clear && '.g:CodeceptionRunPhar.'  --filter "/::'.@f.'.*(.*)/"' 
   execute l:command
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithCodeceptionWithCodeCoverage()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let command =  g:CodeceptionRun.'  --coverage-text --filter "/::'.@f.'.*(.*)/" %<cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

function! RunOneFunctionWithCodeception2WithCodeCoverage()
   let l:winview = winsaveview()
   let l:functionName = input('function name: ')
   let command =  g:CodeceptionRun.' --coverage-text --filter "/::'.l:functionName.'.*(.*)/" <cr>' 
   execute 'normal '.command.''
   call winrestview(l:winview)
endfunction

"it get the name of function where I am insede
function! TestThisFunctionWithCodeCoverage()
   let l:winview = winsaveview()
   execute 'normal ?functionwvwh"fy'
   let l:command =  ':!clear && '.g:CodeceptionRunPhar.'  --coverage-text --filter "/::'.@f.'.*(.*)/"' 
   execute l:command
   call winrestview(l:winview)
endfunction
