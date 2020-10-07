<?php

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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'team_create',
            ],
            [
                'id'    => 20,
                'title' => 'team_edit',
            ],
            [
                'id'    => 21,
                'title' => 'team_show',
            ],
            [
                'id'    => 22,
                'title' => 'team_delete',
            ],
            [
                'id'    => 23,
                'title' => 'team_access',
            ],
            [
                'id'    => 24,
                'title' => 'setting_access',
            ],
            [
                'id'    => 25,
                'title' => 'unit_create',
            ],
            [
                'id'    => 26,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 27,
                'title' => 'unit_show',
            ],
            [
                'id'    => 28,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 29,
                'title' => 'unit_access',
            ],
            [
                'id'    => 30,
                'title' => 'premise_create',
            ],
            [
                'id'    => 31,
                'title' => 'premise_edit',
            ],
            [
                'id'    => 32,
                'title' => 'premise_show',
            ],
            [
                'id'    => 33,
                'title' => 'premise_delete',
            ],
            [
                'id'    => 34,
                'title' => 'premise_access',
            ],
            [
                'id'    => 35,
                'title' => 'group_create',
            ],
            [
                'id'    => 36,
                'title' => 'group_edit',
            ],
            [
                'id'    => 37,
                'title' => 'group_show',
            ],
            [
                'id'    => 38,
                'title' => 'group_delete',
            ],
            [
                'id'    => 39,
                'title' => 'group_access',
            ],
            [
                'id'    => 40,
                'title' => 'course_create',
            ],
            [
                'id'    => 41,
                'title' => 'course_edit',
            ],
            [
                'id'    => 42,
                'title' => 'course_show',
            ],
            [
                'id'    => 43,
                'title' => 'course_delete',
            ],
            [
                'id'    => 44,
                'title' => 'course_access',
            ],
            [
                'id'    => 45,
                'title' => 'activity_create',
            ],
            [
                'id'    => 46,
                'title' => 'activity_edit',
            ],
            [
                'id'    => 47,
                'title' => 'activity_show',
            ],
            [
                'id'    => 48,
                'title' => 'activity_delete',
            ],
            [
                'id'    => 49,
                'title' => 'activity_access',
            ],
            [
                'id'    => 50,
                'title' => 'question_create',
            ],
            [
                'id'    => 51,
                'title' => 'question_edit',
            ],
            [
                'id'    => 52,
                'title' => 'question_show',
            ],
            [
                'id'    => 53,
                'title' => 'question_delete',
            ],
            [
                'id'    => 54,
                'title' => 'question_access',
            ],
            [
                'id'    => 55,
                'title' => 'variant_create',
            ],
            [
                'id'    => 56,
                'title' => 'variant_edit',
            ],
            [
                'id'    => 57,
                'title' => 'variant_show',
            ],
            [
                'id'    => 58,
                'title' => 'variant_delete',
            ],
            [
                'id'    => 59,
                'title' => 'variant_access',
            ],
            [
                'id'    => 60,
                'title' => 'answer_create',
            ],
            [
                'id'    => 61,
                'title' => 'answer_edit',
            ],
            [
                'id'    => 62,
                'title' => 'answer_show',
            ],
            [
                'id'    => 63,
                'title' => 'answer_delete',
            ],
            [
                'id'    => 64,
                'title' => 'answer_access',
            ],
            [
                'id'    => 65,
                'title' => 'documentation_access',
            ],
            [
                'id'    => 66,
                'title' => 'folder_create',
            ],
            [
                'id'    => 67,
                'title' => 'folder_edit',
            ],
            [
                'id'    => 68,
                'title' => 'folder_show',
            ],
            [
                'id'    => 69,
                'title' => 'folder_delete',
            ],
            [
                'id'    => 70,
                'title' => 'folder_access',
            ],
            [
                'id'    => 71,
                'title' => 'document_create',
            ],
            [
                'id'    => 72,
                'title' => 'document_edit',
            ],
            [
                'id'    => 73,
                'title' => 'document_show',
            ],
            [
                'id'    => 74,
                'title' => 'document_delete',
            ],
            [
                'id'    => 75,
                'title' => 'document_access',
            ],
            [
                'id'    => 76,
                'title' => 'review_create',
            ],
            [
                'id'    => 77,
                'title' => 'review_edit',
            ],
            [
                'id'    => 78,
                'title' => 'review_show',
            ],
            [
                'id'    => 79,
                'title' => 'review_delete',
            ],
            [
                'id'    => 80,
                'title' => 'review_access',
            ],
            [
                'id'    => 81,
                'title' => 'signature_create',
            ],
            [
                'id'    => 82,
                'title' => 'signature_edit',
            ],
            [
                'id'    => 83,
                'title' => 'signature_show',
            ],
            [
                'id'    => 84,
                'title' => 'signature_delete',
            ],
            [
                'id'    => 85,
                'title' => 'signature_access',
            ],
            [
                'id'    => 86,
                'title' => 'template_create',
            ],
            [
                'id'    => 87,
                'title' => 'template_edit',
            ],
            [
                'id'    => 88,
                'title' => 'template_show',
            ],
            [
                'id'    => 89,
                'title' => 'template_delete',
            ],
            [
                'id'    => 90,
                'title' => 'template_access',
            ],
            [
                'id'    => 91,
                'title' => 'score_create',
            ],
            [
                'id'    => 92,
                'title' => 'score_edit',
            ],
            [
                'id'    => 93,
                'title' => 'score_show',
            ],
            [
                'id'    => 94,
                'title' => 'score_delete',
            ],
            [
                'id'    => 95,
                'title' => 'score_access',
            ],
            [
                'id'    => 96,
                'title' => 'publication_create',
            ],
            [
                'id'    => 97,
                'title' => 'publication_edit',
            ],
            [
                'id'    => 98,
                'title' => 'publication_show',
            ],
            [
                'id'    => 99,
                'title' => 'publication_delete',
            ],
            [
                'id'    => 100,
                'title' => 'publication_access',
            ],
            [
                'id'    => 101,
                'title' => 'examination_access',
            ],
            [
                'id'    => 102,
                'title' => 'system_access',
            ],
            [
                'id'    => 103,
                'title' => 'config_create',
            ],
            [
                'id'    => 104,
                'title' => 'config_edit',
            ],
            [
                'id'    => 105,
                'title' => 'config_show',
            ],
            [
                'id'    => 106,
                'title' => 'config_delete',
            ],
            [
                'id'    => 107,
                'title' => 'config_access',
            ],
            [
                'id'    => 108,
                'title' => 'bill_create',
            ],
            [
                'id'    => 109,
                'title' => 'bill_edit',
            ],
            [
                'id'    => 110,
                'title' => 'bill_show',
            ],
            [
                'id'    => 111,
                'title' => 'bill_delete',
            ],
            [
                'id'    => 112,
                'title' => 'bill_access',
            ],
            [
                'id'    => 113,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
