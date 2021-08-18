<?php

use Tests\TestCase;

class MakeTempFileTest extends TestCase{
  
  public function testMakeTempFile() {
    
    $base = uniqid('tests').'.txt';
    $path = mktempfile($base);
    $this->assertStringContainsString('-tests', $path);
    $this->assertStringContainsString(sys_get_temp_dir(), $path);
    $this->assertTrue(file_exists($path));
  }
  public function testTempFileAutoRemoved() {
    // generate source code
    // and  test register_shutdown_function.
    $func_declared_files = [];
    $func_declared_files[] = (new \ReflectionFunction('mktempfile'))->getFileName();
    $source_code = "<?php
      require_once '{$func_declared_files[0]}';
      \$path = mktempfile('tests');
      echo \$path;
    ";
    $source_code = join(PHP_EOL, array_map('trim', preg_split('/\n/', $source_code)));
    $temporary_file_using_mktempfile = tmpfile();
    $path = stream_get_meta_data($temporary_file_using_mktempfile)['uri'];
    fwrite($temporary_file_using_mktempfile, $source_code);
    $generated_tmp_path = system("php '${path}'");
    $this->assertFileDoesNotExist($generated_tmp_path);
    
    
  }
}