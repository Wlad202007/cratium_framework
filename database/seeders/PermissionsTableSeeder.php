<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'setting_access',
            ],
            [
                'id'    => 23,
                'title' => 'unit_create',
            ],
            [
                'id'    => 24,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 25,
                'title' => 'unit_show',
            ],
            [
                'id'    => 26,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 27,
                'title' => 'unit_access',
            ],
            [
                'id'    => 28,
                'title' => 'premise_create',
            ],
            [
                'id'    => 29,
                'title' => 'premise_edit',
            ],
            [
                'id'    => 30,
                'title' => 'premise_show',
            ],
            [
                'id'    => 31,
                'title' => 'premise_delete',
            ],
            [
                'id'    => 32,
                'title' => 'premise_access',
            ],
            [
                'id'    => 33,
                'title' => 'course_create',
            ],
            [
                'id'    => 34,
                'title' => 'course_edit',
            ],
            [
                'id'    => 35,
                'title' => 'course_show',
            ],
            [
                'id'    => 36,
                'title' => 'course_delete',
            ],
            [
                'id'    => 37,
                'title' => 'course_access',
            ],
            [
                'id'    => 38,
                'title' => 'group_create',
            ],
            [
                'id'    => 39,
                'title' => 'group_edit',
            ],
            [
                'id'    => 40,
                'title' => 'group_show',
            ],
            [
                'id'    => 41,
                'title' => 'group_delete',
            ],
            [
                'id'    => 42,
                'title' => 'group_access',
            ],
            [
                'id'    => 43,
                'title' => 'activity_create',
            ],
            [
                'id'    => 44,
                'title' => 'activity_edit',
            ],
            [
                'id'    => 45,
                'title' => 'activity_show',
            ],
            [
                'id'    => 46,
                'title' => 'activity_delete',
            ],
            [
                'id'    => 47,
                'title' => 'activity_access',
            ],
            [
                'id'    => 48,
                'title' => 'question_create',
            ],
            [
                'id'    => 49,
                'title' => 'question_edit',
            ],
            [
                'id'    => 50,
                'title' => 'question_show',
            ],
            [
                'id'    => 51,
                'title' => 'question_delete',
            ],
            [
                'id'    => 52,
                'title' => 'question_access',
            ],
            [
                'id'    => 53,
                'title' => 'variant_create',
            ],
            [
                'id'    => 54,
                'title' => 'variant_edit',
            ],
            [
                'id'    => 55,
                'title' => 'variant_show',
            ],
            [
                'id'    => 56,
                'title' => 'variant_delete',
            ],
            [
                'id'    => 57,
                'title' => 'variant_access',
            ],
            [
                'id'    => 58,
                'title' => 'answer_create',
            ],
            [
                'id'    => 59,
                'title' => 'answer_edit',
            ],
            [
                'id'    => 60,
                'title' => 'answer_show',
            ],
            [
                'id'    => 61,
                'title' => 'answer_delete',
            ],
            [
                'id'    => 62,
                'title' => 'answer_access',
            ],
            [
                'id'    => 63,
                'title' => 'documentation_access',
            ],
            [
                'id'    => 64,
                'title' => 'document_create',
            ],
            [
                'id'    => 65,
                'title' => 'document_edit',
            ],
            [
                'id'    => 66,
                'title' => 'document_show',
            ],
            [
                'id'    => 67,
                'title' => 'document_delete',
            ],
            [
                'id'    => 68,
                'title' => 'document_access',
            ],
            [
                'id'    => 69,
                'title' => 'review_create',
            ],
            [
                'id'    => 70,
                'title' => 'review_edit',
            ],
            [
                'id'    => 71,
                'title' => 'review_show',
            ],
            [
                'id'    => 72,
                'title' => 'review_delete',
            ],
            [
                'id'    => 73,
                'title' => 'review_access',
            ],
            [
                'id'    => 74,
                'title' => 'folder_create',
            ],
            [
                'id'    => 75,
                'title' => 'folder_edit',
            ],
            [
                'id'    => 76,
                'title' => 'folder_show',
            ],
            [
                'id'    => 77,
                'title' => 'folder_delete',
            ],
            [
                'id'    => 78,
                'title' => 'folder_access',
            ],
            [
                'id'    => 79,
                'title' => 'signature_create',
            ],
            [
                'id'    => 80,
                'title' => 'signature_edit',
            ],
            [
                'id'    => 81,
                'title' => 'signature_show',
            ],
            [
                'id'    => 82,
                'title' => 'signature_delete',
            ],
            [
                'id'    => 83,
                'title' => 'signature_access',
            ],
            [
                'id'    => 84,
                'title' => 'template_create',
            ],
            [
                'id'    => 85,
                'title' => 'template_edit',
            ],
            [
                'id'    => 86,
                'title' => 'template_show',
            ],
            [
                'id'    => 87,
                'title' => 'template_delete',
            ],
            [
                'id'    => 88,
                'title' => 'template_access',
            ],
            [
                'id'    => 89,
                'title' => 'score_create',
            ],
            [
                'id'    => 90,
                'title' => 'score_edit',
            ],
            [
                'id'    => 91,
                'title' => 'score_show',
            ],
            [
                'id'    => 92,
                'title' => 'score_delete',
            ],
            [
                'id'    => 93,
                'title' => 'score_access',
            ],
            [
                'id'    => 94,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 95,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 96,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
