<?php

return [
    'userManagement' => [
        'title'          => 'Správa používateľov',
        'title_singular' => 'Správa používateľov',
    ],
    'permission'     => [
        'title'          => 'Povolenia',
        'title_singular' => 'Povolenie',
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
        'title'          => 'Role',
        'title_singular' => 'Rola',
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
        'title'          => 'Používatelia',
        'title_singular' => 'Používateľ',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'First Name',
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
            'degree'                    => 'Degree',
            'degree_helper'             => ' ',
            'academic_status'           => 'Academic Status',
            'academic_status_helper'    => ' ',
            'position'                  => 'Position',
            'position_helper'           => ' ',
            'phone'                     => 'Phone',
            'phone_helper'              => ' ',
            'approved'                  => 'Approved',
            'approved_helper'           => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
            'last_name'                 => 'Last Name',
            'last_name_helper'          => ' ',
            'middle_name'               => 'Middle Name',
            'middle_name_helper'        => ' ',
        ],
    ],
    'auditLog'       => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
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
        'title'          => 'Study',
        'title_singular' => 'Study',
    ],
    'unit'           => [
        'title'          => 'Unit',
        'title_singular' => 'Unit',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'type'                     => 'Type',
            'type_helper'              => ' ',
            'managers'                 => 'Managers',
            'managers_helper'          => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'head'                     => 'Head',
            'head_helper'              => ' ',
            'parent'                   => 'Parent',
            'parent_helper'            => ' ',
            'financial_details'        => 'Financial Details',
            'financial_details_helper' => ' ',
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
            'description'        => 'Description',
            'description_helper' => ' ',
            'head'               => 'Head',
            'head_helper'        => ' ',
            'parent'             => 'Parent',
            'parent_helper'      => ' ',
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
            'priority'             => 'Priority',
            'priority_helper'      => ' ',
            'author'               => 'Author',
            'author_helper'        => ' ',
            'premise'              => 'Premise',
            'premise_helper'       => ' ',
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
            'priority'           => 'Priority',
            'priority_helper'    => ' ',
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
    'documentation'  => [
        'title'          => 'Documentation',
        'title_singular' => 'Documentation',
    ],
    'folder'         => [
        'title'          => 'Folders',
        'title_singular' => 'Folder',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'color'             => 'Color',
            'color_helper'      => ' ',
            'users'             => 'Users',
            'users_helper'      => ' ',
            'groups'            => 'Groups',
            'groups_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'admin'             => 'Admin',
            'admin_helper'      => ' ',
            'parent'            => 'Parent',
            'parent_helper'     => ' ',
        ],
    ],
    'document'       => [
        'title'          => 'Documents',
        'title_singular' => 'Document',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'int_number'        => 'Int Number',
            'int_number_helper' => ' ',
            'ext_number'        => 'Ext Number',
            'ext_number_helper' => ' ',
            'scan'              => 'Scan',
            'scan_helper'       => ' ',
            'unit'              => 'Unit',
            'unit_helper'       => ' ',
            'author'            => 'Author',
            'author_helper'     => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'body'              => 'Body',
            'body_helper'       => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'shares'            => 'Shares',
            'shares_helper'     => ' ',
            'folders'           => 'Folders',
            'folders_helper'    => ' ',
            'cost'              => 'Cost',
            'cost_helper'       => ' ',
        ],
    ],
    'review'         => [
        'title'          => 'Reviews',
        'title_singular' => 'Review',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'body'              => 'Body',
            'body_helper'       => ' ',
            'author'            => 'Author',
            'author_helper'     => ' ',
            'document'          => 'Document',
            'document_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'signature'      => [
        'title'          => 'Signature',
        'title_singular' => 'Signature',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'document'          => 'Document',
            'document_helper'   => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'file'              => 'File',
            'file_helper'       => ' ',
            'confirm'           => 'Confirmation',
            'confirm_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'template'       => [
        'title'          => 'Template',
        'title_singular' => 'Template',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'body'              => 'Body',
            'body_helper'       => ' ',
            'units'             => 'Units',
            'units_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'score'          => [
        'title'          => 'Scores',
        'title_singular' => 'Score',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'author'            => 'Author',
            'author_helper'     => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'activity'          => 'Activity',
            'activity_helper'   => ' ',
        ],
    ],
    'publication'    => [
        'title'          => 'Publications',
        'title_singular' => 'Publication',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'date'                  => 'Date',
            'date_helper'           => ' ',
            'edition'               => 'Edition',
            'edition_helper'        => ' ',
            'database'              => 'Database',
            'database_helper'       => ' ',
            'url'                   => 'URL',
            'url_helper'            => ' ',
            'document'              => 'Document',
            'document_helper'       => ' ',
            'author'                => 'Author',
            'author_helper'         => ' ',
            'edition_number'        => 'Edition Number',
            'edition_number_helper' => ' ',
            'pages_count'           => 'Pages Count',
            'pages_count_helper'    => ' ',
            'location'              => 'Location',
            'location_helper'       => ' ',
            'type'                  => 'Type',
            'type_helper'           => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'coauthors'             => 'Co-Authors',
            'coauthors_helper'      => ' ',
        ],
    ],
    'examination'    => [
        'title'          => 'Examination',
        'title_singular' => 'Examination',
    ],
    'system'         => [
        'title'          => 'System',
        'title_singular' => 'System',
    ],
    'config'         => [
        'title'          => 'Configs',
        'title_singular' => 'Config',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'term'              => 'Term',
            'term_helper'       => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'parent'            => 'Parent',
            'parent_helper'     => ' ',
        ],
    ],
    'bill'           => [
        'title'          => 'Bills',
        'title_singular' => 'Bill',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'amount'            => 'Amount',
            'amount_helper'     => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'author'            => 'Author',
            'author_helper'     => ' ',
            'scan'              => 'Scan',
            'scan_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'unit'              => 'Unit',
            'unit_helper'       => ' ',
        ],
    ],
];
