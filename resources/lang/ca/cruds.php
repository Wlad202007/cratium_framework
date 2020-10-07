<?php

return [
    'userManagement' => [
        'title'          => 'Gestió d\'usuaris',
        'title_singular' => 'Gestió d\'usuaris',
    ],
    'permission'     => [
        'title'          => 'Permisos',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Rols',
        'title_singular' => 'Rol',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Usuaris',
        'title_singular' => 'Usuari',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'team'                      => 'Team',
            'team_helper'               => ' ',
            'approved'                  => 'Approved',
            'approved_helper'           => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
        ],
    ],
    'team'           => [
        'title'          => 'Teams',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'owner'             => 'Owner',
            'owner_helper'      => ' ',
        ],
    ],
    'setting'        => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
    ],
    'unit'           => [
        'title'          => 'Unit',
        'title_singular' => 'Unit',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'managers'          => 'Managers',
            'managers_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'head'              => 'Head',
            'head_helper'       => ' ',
            'parent'            => 'Parent',
            'parent_helper'     => ' ',
        ],
    ],
    'premise'        => [
        'title'          => 'Premise',
        'title_singular' => 'Premise',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'capacity'          => 'Capacity',
            'capacity_helper'   => ' ',
            'gps'               => 'GPS',
            'gps_helper'        => ' ',
            'unit'              => 'Unit',
            'unit_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'parent'            => 'Parent',
            'parent_helper'     => ' ',
        ],
    ],
    'course'         => [
        'title'          => 'Course',
        'title_singular' => 'Course',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'literature'         => 'Literature',
            'literature_helper'  => ' ',
            'authors'            => 'Authors',
            'authors_helper'     => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'hours'              => 'Hours',
            'hours_helper'       => ' ',
            'credits'            => 'Credits',
            'credits_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'groups'             => 'Groups',
            'groups_helper'      => ' ',
            'video'              => 'Video (URL)',
            'video_helper'       => ' ',
            'thumbnail'          => 'Thumbnail',
            'thumbnail_helper'   => ' ',
        ],
    ],
    'group'          => [
        'title'          => 'Groups',
        'title_singular' => 'Group',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'unit'               => 'Unit',
            'unit_helper'        => ' ',
            'members'            => 'Members',
            'members_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'parent'             => 'Parent',
            'parent_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'head'               => 'Head',
            'head_helper'        => ' ',
        ],
    ],
    'activity'       => [
        'title'          => 'Activity',
        'title_singular' => 'Activity',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'type'                 => 'Type',
            'type_helper'          => ' ',
            'score'                => 'Score',
            'score_helper'         => ' ',
            'duration'             => 'Duration',
            'duration_helper'      => ' ',
            'time_start'           => 'Time Start',
            'time_start_helper'    => ' ',
            'time_end'             => 'Time End',
            'time_end_helper'      => ' ',
            'video'                => 'Video',
            'video_helper'         => ' ',
            'files'                => 'Files',
            'files_helper'         => ' ',
            'test_per_page'        => 'Test Per Page',
            'test_per_page_helper' => ' ',
            'time_per_test'        => 'Time Per Test',
            'time_per_test_helper' => ' ',
            'mode'                 => 'Mode',
            'mode_helper'          => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'course'               => 'Course',
            'course_helper'        => ' ',
            'checkin'              => 'Checkin',
            'checkin_helper'       => ' ',
            'moderator'            => 'Moderator',
            'moderator_helper'     => ' ',
        ],
    ],
    'question'       => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'question'           => 'Question',
            'question_helper'    => ' ',
            'explanation'        => 'Explanation',
            'explanation_helper' => ' ',
            'files'              => 'Files',
            'files_helper'       => ' ',
            'score'              => 'Score',
            'score_helper'       => ' ',
            'activity'           => 'Activity',
            'activity_helper'    => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'type'               => 'Type',
            'type_helper'        => ' ',
        ],
    ],
    'variant'        => [
        'title'          => 'Variants',
        'title_singular' => 'Variant',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'answer'         => [
        'title'          => 'Answers',
        'title_singular' => 'Answer',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'user'               => 'User',
            'user_helper'        => ' ',
            'variant'            => 'Variant',
            'variant_helper'     => ' ',
            'media'              => 'Media',
            'media_helper'       => ' ',
            'long_answer'        => 'Long Answer',
            'long_answer_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
];
