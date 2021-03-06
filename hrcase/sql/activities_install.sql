SELECT @caseCompId := id FROM `civicrm_component` where `name` like 'CiviCase';
SELECT @option_group_id_activity_type        := max(id) from civicrm_option_group where name = 'activity_type';
SELECT @max_val := MAX(ROUND(op.value)) FROM civicrm_option_value op WHERE op.option_group_id  =
   @option_group_id_activity_type;

INSERT INTO
   `civicrm_option_value` (`option_group_id`, `label`,`name`, `value`,  `grouping`, `filter`, `is_default`,
   `weight`, `description`, `is_optgroup`, `is_reserved`, `is_active`, `component_id` )
VALUES

(@option_group_id_activity_type, 'Schedule joining date','Schedule joining date',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Issue appointment letter','Issue appointment letter',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Fill Employee Details Form','Fill Employee Details Form',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Submission of ID/Residence proofs and photos','Submission of ID/Residence proofs and photos',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Program and work induction by program supervisor','Program and work induction by program supervisor',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Enter employee data in CiviHR','Enter employee data in CiviHR',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Group Orientation to organization, values, policies','Group Orientation to organization, values, policies',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Probation appraisal (start probation workflow)','Probation appraisal (start probation workflow)',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Conduct appraisal','Conduct appraisal',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Collection of appraisal paperwork','Collection of appraisal paperwork',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Issue confirmation/warning letter','Issue confirmation/warning letter',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Schedule Exit Interview','Schedule Exit Interview',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Get "No Dues" certification','Get "No Dues" certification',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Conduct Exit interview','Conduct Exit interview',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Revoke access to databases','Revoke access to databases',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Block work email ID','Block work email ID',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Prepare formats','Prepare formats',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Print formats','Print formats',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Collate and print goals','Collate and print goals',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Prepare and email schedule','Prepare and email schedule',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Follow up on progress','Follow up on progress',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Collection of Appraisal forms','Collection of Appraisal forms',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Issue extension letter','Issue extension letter',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'Background Check','Background_Check',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId ),
(@option_group_id_activity_type, 'References Check','References Check',
  (SELECT @max_val := @max_val+1), NULL, 0,  0, (SELECT @max_val := @max_val+1), '',  0, 0, 1, @caseCompId );

  
