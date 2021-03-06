<?php
/*
+--------------------------------------------------------------------+
| CiviHR version 1.4                                                 |
+--------------------------------------------------------------------+
| Copyright CiviCRM LLC (c) 2004-2014                                |
+--------------------------------------------------------------------+
| This file is a part of CiviCRM.                                    |
|                                                                    |
| CiviCRM is free software; you can copy, modify, and distribute it  |
| under the terms of the GNU Affero General Public License           |
| Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
|                                                                    |
| CiviCRM is distributed in the hope that it will be useful, but     |
| WITHOUT ANY WARRANTY; without even the implied warranty of         |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
| See the GNU Affero General Public License for more details.        |
|                                                                    |
| You should have received a copy of the GNU Affero General Public   |
| License and the CiviCRM Licensing Exception along                  |
| with this program; if not, contact CiviCRM LLC                     |
| at info[AT]civicrm[DOT]org. If you have questions about the        |
| GNU Affero General Public License or the licensing of CiviCRM,     |
| see the CiviCRM license FAQ at http://civicrm.org/licensing        |
+--------------------------------------------------------------------+
*/

/**
 * Collection of upgrade steps
 */
class CRM_HRReport_Upgrader extends CRM_HRReport_Upgrader_Base {

  // By convention, functions that look like "function upgrade_NNNN()" are
  // upgrade tasks. They are executed in order (like Drupal's hook_update_N).

  /**
   * Example: Run an external SQL script when the module is installed
   *
  public function install() {
    $this->executeSqlFile('sql/myinstall.sql');
  }

  /**
   * Example: Run an external SQL script when the module is uninstalled
   *
  public function uninstall() {
   $this->executeSqlFile('sql/myuninstall.sql');
  }

  /**
   * Example: Run a simple query when a module is enabled
   *
  public function enable() {
    CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 1 WHERE bar = "whiz"');
  }

  /**
   * Example: Run a simple query when a module is disabled
   *
  public function disable() {
    CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 0 WHERE bar = "whiz"');
  }

  /**
   * Example: Run a couple simple queries
   *
   * @return TRUE on success
   * @throws Exception
   *
  public function upgrade_4200() {
    $this->ctx->log->info('Applying update 4200');
    CRM_Core_DAO::executeQuery('UPDATE foo SET bar = "whiz"');
    CRM_Core_DAO::executeQuery('DELETE FROM bang WHERE willy = wonka(2)');
    return TRUE;
  } // */


  /**
   * Example: Run an external SQL script
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4201() {
    $this->ctx->log->info('Applying update 4201');
    // this path is relative to the extension base dir
    $this->executeSqlFile('sql/upgrade_4201.sql');
    return TRUE;
  } // */


  /**
   * Example: Run a slow upgrade process by breaking it up into smaller chunk
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4202() {
    $this->ctx->log->info('Planning update 4202'); // PEAR Log interface

    $this->addTask(ts('Process first step'), 'processPart1', $arg1, $arg2);
    $this->addTask(ts('Process second step'), 'processPart2', $arg3, $arg4);
    $this->addTask(ts('Process second step'), 'processPart3', $arg5);
    return TRUE;
  }
  public function processPart1($arg1, $arg2) { sleep(10); return TRUE; }
  public function processPart2($arg3, $arg4) { sleep(10); return TRUE; }
  public function processPart3($arg5) { sleep(10); return TRUE; }
  // */


  /**
   * Example: Run an upgrade with a query that touches many (potentially
   * millions) of records by breaking it up into smaller chunks.
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4203() {
    $this->ctx->log->info('Planning update 4203'); // PEAR Log interface

    $minId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(min(id),0) FROM civicrm_contribution');
    $maxId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(max(id),0) FROM civicrm_contribution');
    for ($startId = $minId; $startId <= $maxId; $startId += self::BATCH_SIZE) {
      $endId = $startId + self::BATCH_SIZE - 1;
      $title = ts('Upgrade Batch (%1 => %2)', array(
        1 => $startId,
        2 => $endId,
      ));
      $sql = '
        UPDATE civicrm_contribution SET foobar = whiz(wonky()+wanker)
        WHERE id BETWEEN %1 and %2
      ';
      $params = array(
        1 => array($startId, 'Integer'),
        2 => array($endId, 'Integer'),
      );
      $this->addTask($title, 'executeSql', $sql, $params);
    }
    return TRUE;
  } // */

  public function upgrade_1100() {
    $this->ctx->log->info('Planning update 1100'); // PEAR Log interface
    $params = array(
      1 => array("CiviHR Annual and Monthly Cost Equivalents Report", 'String'),
    );
    $formValues = CRM_Core_DAO::singleValueQuery('SELECT form_values FROM civicrm_report_instance where title = %1',$params);
    $arrayFormValues = unserialize($formValues);
    $arrayFormValues["fields"]["hrjob_pay_currency"] = 1;
    $arrayFormValues["group_bys"]["hrjob_pay_currency"] = 1;

    $formValues = serialize($arrayFormValues);
    $params[2] = array($formValues, 'String');
    $sql = 'UPDATE civicrm_report_instance SET form_values = %2 WHERE title = %1';
    CRM_Core_DAO::executeQuery($sql, $params);

    return TRUE;
  }

  public function upgrade_1300() {
    $this->ctx->log->info('Planning update 1300'); // PEAR Log interface
    CRM_Core_DAO::executeQuery("UPDATE civicrm_report_instance SET title = 'CiviHR Job Detail Report', description = 'HR Report showing drilled down job details at individual level. ' WHERE report_id = 'civihr/detail'");
    CRM_Core_DAO::executeQuery("UPDATE civicrm_option_value SET label = 'CiviHR Job Detail Report', description = 'HR Report showing drilled down job details at individual level. ' WHERE value = 'civihr/detail' AND name = 'CRM_HRReport_Form_Contact_HRDetail'");
    CRM_Core_DAO::executeQuery("UPDATE civicrm_managed SET name = 'CiviHR Job Detail Report Template' WHERE entity_type = 'ReportTemplate' AND module = 'org.civicrm.hrreport' AND name= 'CiviHR Contact Detail Report Template'");
    CRM_Core_DAO::executeQuery("UPDATE civicrm_managed SET name = 'CiviHR Job Detail Report' WHERE entity_type = 'ReportInstance' AND module = 'org.civicrm.hrreport' AND name= 'CiviHR Contact Detail Report'");
    return TRUE;
  }

  public function upgrade_1400() {
    $this->ctx->log->info('Planning update 1400'); // PEAR Log interface
    $sql = "SELECT * FROM  civicrm_managed WHERE  entity_type = 'ReportInstance' AND name IN ('CiviHR FTE Report', 'CiviHR Annual and Monthly Cost Equivalents Report', 'CiviHR Public Holiday Report','CiviHR Absence Report') ";
    $dao = CRM_Core_DAO::executeQuery($sql);
    while ($dao->fetch()) {
      $url = "civicrm/report/instance/{$dao->entity_id}?reset=1&section=2&snippet=5&context=dashlet";
      $fullscreen_url = "civicrm/report/instance/{$dao->entity_id}?reset=1&section=2&snippet=5&context=dashletFullscreen";
      $name = "report/{$dao->entity_id}";
      $label = $dao->name;
      $domain_id = CRM_Core_Config::domainID();
      $query = " INSERT INTO civicrm_dashboard ( domain_id,url, fullscreen_url, is_active, name,label) VALUES ($domain_id,'{$url}', '{$fullscreen_url}', 1, '{$name}', '{$label}' )";
      CRM_Core_DAO::executeQuery($query);
    }
    return TRUE;
  }

  public function upgrade_1401() {
    $this->ctx->log->info('Planning update 1401'); // PEAR Log interface
    $params = array(
      'title'   => 'CiviHR Current Employees Report',
      'description' => 'HR Report showing drilled down current employee details . ',
      'report_id'   => 'civihr/detail',
      'form_values' => serialize(
        array(
          'fields' => array(
            'id'  => 1,
            'sort_name' => 1,
            'email'     => 1,
            'manager' => 1,
            'hrjob_title' => 1,
          ),
        )
      ),
    );
    $result = civicrm_api3('ReportInstance', 'create', $params);
    CRM_Core_DAO::executeQuery("INSERT INTO civicrm_managed (module, name, entity_type, entity_id) VALUES ('org.civicrm.hrreport', 'CiviHR Current Employees Report', 'ReportInstance', {$result['id']})");

    //Set approved filter ON for Absence report
    $activityStatus = CRM_HRAbsence_BAO_HRAbsenceType::getActivityStatus();
    $update_formValues = serialize(
      array(
        'addToDashboard' => 1,
        'fields' => array(
          'id'  => 1,
          'contact_target' => 1,
          'activity_type_id' => 1,
          'duration' => 1,
          'absence_date' => 1,
          'status_id' => 1,
          'this.month' => 1,
        ),
        'status_id_op' => 'in',
        'status_id_value' => array(array_search('Approved', $activityStatus)),
      ));
    CRM_Core_DAO::executeQuery("UPDATE civicrm_report_instance SET form_values = '{$update_formValues}' WHERE id = (SELECT entity_id from civicrm_managed where name = 'CiviHR Absence Report')");

    return TRUE;
  }
}
