<?php
if(function_exists('html_var_dump'))
{
	return;
	exit();
}
/**
 * Like var_dump, but modifies the output with htmlspecialchars()
 *
 * For example:
 * <code>
 * $str = "butter & bread";
 * var_dump($str); // Output: string(14) "butter & bread"
 * html_var_dump($str); // Output: string(14) "butter &amp; bread"
 * </code>
 */

function html_var_dump($var)
{
    // catch the output of var_dump
    ob_start();
    var_dump($var);
    $buf .= ob_get_contents();
    ob_end_clean();

    // now, print the html-safe dump
    print htmlspecialchars($buf);
}

/**
 * Works in conjunction with the debug function to pretty-print objects.
 *
 * The only reason to make the $obj argument call-by-reference is to avoid
 * creation of unnecessary copies of objects. In PHP, all non-object data types
 * have a copy-on-write semantic, so there would be no performance difference
 * between a call-by-reference and call-by-value. To summarize, the only reason
 * to make the $obj argument call-by-reference is performance.
 *
 * @return string
 * @param object $obj A reference to the object to pretty-print
 * @param bool $b_verbose A boolean that indicates whether to print verbose output.
 * @param int $i_indent The current intendation level.
 */
function dump_object(&$obj, $b_verbose = false, $i_indent = 0)
{
    $str_class = htmlspecialchars(get_class($obj));

    // display object header
    echo '<i><font size="2" color="#000080">object <b>'.$str_class.'<br></font></i></b>';

    // indent a bit more for the object variable names
    $i_indent += 4;

    // walk through the variables of the object...
    $arr = get_object_vars($obj);

    //-- problem fix with because if is empty normal, the _SERVER do not set this variable. $_SERVER['PATH_INFO']
    if (!isset($_SERVER['PATH_INFO']))  $str_path_info = '';
    else                                $str_path_info = $_SERVER['PATH_INFO'];

    $str_random_unique = uniqid('a'); //-- generate random number
    $i=0;

    foreach($arr as $key => $value)
    {
        $str_key = htmlspecialchars($key);

        // print the indentation
        echo str_repeat('&nbsp;', $i_indent);

        //-- calculate the random id
        $str_random = $str_random_unique . $i;
        $i++;

        // and the name of the object variable
        $str_key = '<span id=\''.$str_random.'\' style="color:#CA0000; text-decoration: none;">'.$str_key.'</span>';

        // and index of the
        echo '<font color=red size=2>[</font><font size=2>'.$str_key.'</font><font color=red>]</font> => ';

        // ...and start another recursion, use str_random, to reduce to use uniqid function
        dump_arbitrary($value, $b_verbose, $i_indent + 4, $str_random);
    }
}

/**
 * Works in conjunction with the debug function to pretty-print arrays.
 *
 * @return string
 * @param array $arr A reference to the object to pretty-print
 * @param bool $b_verbose A boolean that indicates whether to print verbose output.
 * @param int $i_indent The current intendation level.
 */
function dump_array($arr, $b_verbose = false, $i_indent = 0)
{
    $i_count = count($arr);

    // display array header
    echo '<b><i><font size="2" color="#000080">Array('.$i_count.')</font></i></b><br>';

    // indent a bit more for the array keys
    $i_indent += 4;

    //-- problem fix with because if is empty normal, the _SERVER do not set this variable. $_SERVER['PATH_INFO']
    if (!isset($_SERVER['PATH_INFO']))  $str_path_info = '';
    else                                $str_path_info = $_SERVER['PATH_INFO'];

    $str_random_unique = uniqid('k'); //-- generate random number
    $i=0;

    // iterate through all items of the array
    foreach($arr as $key => $value)
    {
        $str_key = htmlspecialchars($key);

        // print the indentation
        echo str_repeat('&nbsp;', $i_indent);
		//echo '<img src="./images/spacer.gif" width="'.($i_indent*10).'">';
        //-- calculate the random id
        $str_random = $str_random_unique . $i;
        $i++;

        $str_key = '<span id=\''.$str_random.'\' style="color:#CA0000; text-decoration: none;">'.$str_key.'</span>';

        // and index of the
        echo '<font color=red size=2>[</font><font size=2>'.$str_key.'</font><font size=2 color=red>]</font> => ';

        // ...and start another recursion
        dump_arbitrary($value, $b_verbose, $i_indent + 4, $str_random);
    }
}

 /**
 * Works in conjunction with the debug function to pretty-print a scalar value.
 *
 * @return string
 * @param mixed $var The scalar value to pretty-print
 * @param bool $b_verbose A boolean that indicates whether to print verbose output.
 */

function dump_scalar($var, $b_verbose = false, $str_unique_id='')
{
    if ($b_verbose)
    {
        // catch the output of var_dump
        ob_start();
        var_dump($var);
        $buf .= ob_get_contents();
        ob_end_clean();
    }
    else
    {
        if (is_bool($var))
        {
            // display booleans a special way
            // i hope this looks more intuitive
            if ($var)
            {
                $buf = "bool(true)";
            }
            else
            {
            	$buf = "bool(false)";
            }
        }
        else
        {
        	//-- problem fix with because if is empty normal, the _SERVER do not set this variable. $_SERVER['PATH_INFO']
        	if (!isset($_SERVER['PATH_INFO']))  $str_path_info = '';
        	else                                $str_path_info = $_SERVER['PATH_INFO'];

        	// just display the type and string value of the
        	if (empty($str_unique_id)) $str_random = uniqid ('v'); //-- generate random number
        	else $str_random = $str_unique_id.'a';  //-- cannot be duplicate with another

        	//-- add debug information including link
        	$buf = gettype($var).'('.strlen($var).') '.' <b style="color:#008400; text-decoration: none; "><span id=\''.$str_random.'\'>' . htmlspecialchars(strval($var)) . '</span></b>'."\n";
        }
    }

    echo '<font size=2 color=#408080>'.$buf.'</font><br>';
}

/**
 * Works in conjunction with the debug function to pretty-print a variable of arbitrary type.
 *
 * @return string
 * @param mixed $var A reference to the variable to pretty-print
 * @param bool $b_verbose A boolean that indicates whether to print verbose output.
 * @param int $i_indent The current intendation level.
 */
function dump_arbitrary(&$var, $b_verbose = false, $i_indent = 0, $str_unique_id='')
{
    // if the var is an array, recurse...
    if (is_array($var))
    {
        dump_array($var, $b_verbose, $i_indent);
    }

    // ... or display the object contents if the var is an object ...
    else if (is_object($var))
    {
        dump_object($var, $b_verbose, $i_indent);
    }

    // ...or else dump the var.
    else
    {
        dump_scalar($var, $b_verbose, $str_unique_id);
    }
}

/**
 * Pretty-prints a variable of arbitrary type.
 *
 * Used to have a more readable debug output than a plain var_dump
 *
 * This is thought as an improved var_dump.
 * It formats a variable of arbitrary type as pretty-printed html
 * and prints it.
 *
 * Please note that this function will only print something if the
 * debugging mode is turned on or the argument $b_force is set to true.
 *
 * @return void
 * @param mixed $var The variable to pretty-print
 * @param string $str_title A boolean that indicates whether to print verbose output.
 * @param bool $b_verbose A boolean that indicates whether to print verbose output.
 * @param bool $b_force The current intendation level.
 */
function debug($var, $str_title = '[debug output]', $b_verbose = false)
{
	// debug mode set or $b_force set to true?
	$str_title = htmlspecialchars($str_title);

	// print header
	echo '<table style="background:#ffffff; color:#000"><tr><td style="color:#000">';
	echo '<font face="courier new, courier" size="2">'."\n";
	echo '<hr size="1" noshade><b>'.$str_title.':</b><br>';
	echo '<pre>';

	// dump the variable
	dump_arbitrary($var, $b_verbose);

	// print footer
	echo '</pre>';
	echo '<br><hr size="1" noshade>'."\n";
	echo '</font>'."\n";
	echo '</td></tr></tr></table>';
}

/**
 * Pretty-print the GLOBALS array.
 *
 * This function tries to prevent endless recursive loops by
 * removing the self-reference of the GLOBALS array to itself.
 * This should work in 99% of all case to prevent an endless
 * recursion, it will not work if any of the global variables
 * contains a self-reference.
 * @return void
 */
function debug_globals()
{
    $tmp = $GLOBALS;
    unset($tmp['GLOBALS']);
    debug($tmp);
}

?>
