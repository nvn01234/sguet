<?php

use Illuminate\Database\Seeder;
use \Amranidev\ScaffoldInterface\Models\Scaffoldinterface;

class ScaffoldInterfacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scaffoldinterface::create([
            'migration' => base_path('database/migrations/2017_01_11_044400_positions.php'),
            'model' => base_path('app/Position.php'),
            'controller' => base_path('app/Http/Controllers/PositionController.php'),
            'views' => base_path('resources/views/position'),
            'tablename' => 'positions'
        ]);

        Scaffoldinterface::create([
            'migration' => base_path('database/migrations/2017_01_11_044818_members.php'),
            'model' => base_path('app/Member.php'),
            'controller' => base_path('app/Http/Controllers/MemberController.php'),
            'views' => base_path('resources/views/member'),
            'tablename' => 'members'
        ]);

        Scaffoldinterface::create([
            'migration' => base_path('database/migrations/2017_01_11_044931_teams.php'),
            'model' => base_path('app/Team.php'),
            'controller' => base_path('app/Http/Controllers/TeamController.php'),
            'views' => base_path('resources/views/team'),
            'tablename' => 'teams'
        ]);

        Scaffoldinterface::create([
            'migration' => base_path('database/migrations/2017_01_11_045136_categories.php'),
            'model' => base_path('app/Category.php'),
            'controller' => base_path('app/Http/Controllers/CategoryController.php'),
            'views' => base_path('resources/views/category'),
            'tablename' => 'categories'
        ]);

        Scaffoldinterface::create([
            'migration' => base_path('database/migrations/2017_01_11_045137_articles.php'),
            'model' => base_path('app/Article.php'),
            'controller' => base_path('app/Http/Controllers/ArticleController.php'),
            'views' => base_path('resources/views/article'),
            'tablename' => 'articles'
        ]);

        Scaffoldinterface::create([
            'migration' => base_path('database/migrations/2017_01_11_051958_tags.php'),
            'model' => base_path('app/Tag.php'),
            'controller' => base_path('app/Http/Controllers/TagController.php'),
            'views' => base_path('resources/views/tag'),
            'tablename' => 'tags'
        ]);
    }
}
