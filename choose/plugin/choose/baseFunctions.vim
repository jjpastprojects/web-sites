function! GetYmlValue(file, key)
    let values = readfile(a:file)
    for value in values
        if value =~ '^'.a:key.':'
            return substitute(value, a:key.': ','','')
        endif
    endfor
endfunction

function! GetTestYmlFile()
        let pwd = getcwd()
        while pwd != '/'
             if filereadable(pwd.'/test.yml')
               return pwd.'/test.yml'
            endif
            let pwd = fnamemodify(pwd, ':h')
        endwhile
endfunction

function! GetValue(value)
   let file = GetTestYmlFile()
     if file != ''
        return GetYmlValue(file, a:value)
     endif
endfunction
