<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'gestion_des_cour_access',
            ],
            [
                'id'    => '18',
                'title' => 'gestion_des_evaluation_access',
            ],
            [
                'id'    => '19',
                'title' => 'gestion_des_forum_access',
            ],
            [
                'id'    => '20',
                'title' => 'cour_create',
            ],
            [
                'id'    => '21',
                'title' => 'cour_edit',
            ],
            [
                'id'    => '22',
                'title' => 'cour_show',
            ],
            [
                'id'    => '23',
                'title' => 'cour_delete',
            ],
            [
                'id'    => '24',
                'title' => 'cour_access',
            ],
            [
                'id'    => '25',
                'title' => 'chapitre_create',
            ],
            [
                'id'    => '26',
                'title' => 'chapitre_edit',
            ],
            [
                'id'    => '27',
                'title' => 'chapitre_show',
            ],
            [
                'id'    => '28',
                'title' => 'chapitre_delete',
            ],
            [
                'id'    => '29',
                'title' => 'chapitre_access',
            ],
            [
                'id'    => '30',
                'title' => 'lecon_create',
            ],
            [
                'id'    => '31',
                'title' => 'lecon_edit',
            ],
            [
                'id'    => '32',
                'title' => 'lecon_show',
            ],
            [
                'id'    => '33',
                'title' => 'lecon_delete',
            ],
            [
                'id'    => '34',
                'title' => 'lecon_access',
            ],
            [
                'id'    => '35',
                'title' => 'question_create',
            ],
            [
                'id'    => '36',
                'title' => 'question_edit',
            ],
            [
                'id'    => '37',
                'title' => 'question_show',
            ],
            [
                'id'    => '38',
                'title' => 'question_delete',
            ],
            [
                'id'    => '39',
                'title' => 'question_access',
            ],
            [
                'id'    => '40',
                'title' => 'quiz_create',
            ],
            [
                'id'    => '41',
                'title' => 'quiz_edit',
            ],
            [
                'id'    => '42',
                'title' => 'quiz_show',
            ],
            [
                'id'    => '43',
                'title' => 'quiz_delete',
            ],
            [
                'id'    => '44',
                'title' => 'quiz_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
