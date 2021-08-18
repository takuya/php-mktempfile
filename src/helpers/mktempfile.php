<?php
if( !function_exists('mktempfile') ){
  
  function mktempfile( $basename, $prefix=null, $keep_file_after_finished=false):string{
    
    $prefix = $prefix ?? 'php-tempfile';
    $prefix = $prefix.'-'.dechex(crc32(random_bytes(10))).'-';
    $f_name = sys_get_temp_dir().DIRECTORY_SEPARATOR.$prefix.$basename;
    touch($f_name);
    // auto remove by register_shutdown_function.
    if ( !$keep_file_after_finished ){
      register_shutdown_function(function() use ($f_name) {
        @unlink($f_name);
      });
    }
    return $f_name;
  }
}