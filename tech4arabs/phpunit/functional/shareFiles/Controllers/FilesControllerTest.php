<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilesControllerTest extends TestCase
{

    use DatabaseTransactions;

   /**
    * @test
    */
    public function it_search_for_files()
    {
        $this->visit(route('file::search', ['q' => 'f']));
    }


    /**
    * @test
    */
    public function it_show_all_file()
    {
        $this->visit(route('file::index'));
    }


   /**
   * @test
   */
    public function it_add_a_file()
    {
        $name = 'name';
        $description  ='this is a file';
        $this->visit(route('file::add'))
                ->type($name, 'name')
                ->type($description, 'description')
                ->type('http://www.mediafile/filelinks', 'links')
                ->type('this is the university', 'universities')
                ->press(Lang::get('shareFiles::form.add'))
                ->seePageIs(route('file::add'))
                ->see(trans('file.add_success'))
                ->seeInDatabase('files', compact('name', 'description'));
    }


    /**
    * @test
    */
    public function it_show_detail_of_a_file()
    {
        $file = createFile();
        $this->visit(route('file::show', $file->slug));
    }


}
