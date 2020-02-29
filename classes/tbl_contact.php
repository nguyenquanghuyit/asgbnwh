<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for tbl_contact
 */
class tbl_contact extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $ID_Contact;
	public $CodeContact;
	public $ContactType;
	public $ContactName;
	public $CompanyName;
	public $Address;
	public $ContactPhone;
	public $ContactEmail;
	public $ReceiveName;
	public $ReceiveTime;
	public $Note;
	public $CreateUser;
	public $CreateDate;
	public $UpdateUser;
	public $UpdateDate;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_contact';
		$this->TableName = 'tbl_contact';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_contact`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// ID_Contact
		$this->ID_Contact = new DbField('tbl_contact', 'tbl_contact', 'x_ID_Contact', 'ID_Contact', '`ID_Contact`', '`ID_Contact`', 3, -1, FALSE, '`ID_Contact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Contact->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Contact->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Contact->Sortable = FALSE; // Allow sort
		$this->ID_Contact->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Contact'] = &$this->ID_Contact;

		// CodeContact
		$this->CodeContact = new DbField('tbl_contact', 'tbl_contact', 'x_CodeContact', 'CodeContact', '`CodeContact`', '`CodeContact`', 200, -1, FALSE, '`CodeContact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CodeContact->Sortable = TRUE; // Allow sort
		$this->fields['CodeContact'] = &$this->CodeContact;

		// ContactType
		$this->ContactType = new DbField('tbl_contact', 'tbl_contact', 'x_ContactType', 'ContactType', '`ContactType`', '`ContactType`', 200, -1, FALSE, '`ContactType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ContactType->Required = TRUE; // Required field
		$this->ContactType->Sortable = TRUE; // Allow sort
		$this->ContactType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ContactType->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->ContactType->Lookup = new Lookup('ContactType', 'tbl_contact', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->ContactType->OptionCount = 2;
		$this->fields['ContactType'] = &$this->ContactType;

		// ContactName
		$this->ContactName = new DbField('tbl_contact', 'tbl_contact', 'x_ContactName', 'ContactName', '`ContactName`', '`ContactName`', 200, -1, FALSE, '`ContactName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContactName->Required = TRUE; // Required field
		$this->ContactName->Sortable = TRUE; // Allow sort
		$this->fields['ContactName'] = &$this->ContactName;

		// CompanyName
		$this->CompanyName = new DbField('tbl_contact', 'tbl_contact', 'x_CompanyName', 'CompanyName', '`CompanyName`', '`CompanyName`', 200, -1, FALSE, '`CompanyName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CompanyName->Sortable = TRUE; // Allow sort
		$this->fields['CompanyName'] = &$this->CompanyName;

		// Address
		$this->Address = new DbField('tbl_contact', 'tbl_contact', 'x_Address', 'Address', '`Address`', '`Address`', 200, -1, FALSE, '`Address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Address->Required = TRUE; // Required field
		$this->Address->Sortable = TRUE; // Allow sort
		$this->fields['Address'] = &$this->Address;

		// ContactPhone
		$this->ContactPhone = new DbField('tbl_contact', 'tbl_contact', 'x_ContactPhone', 'ContactPhone', '`ContactPhone`', '`ContactPhone`', 200, -1, FALSE, '`ContactPhone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContactPhone->Sortable = TRUE; // Allow sort
		$this->fields['ContactPhone'] = &$this->ContactPhone;

		// ContactEmail
		$this->ContactEmail = new DbField('tbl_contact', 'tbl_contact', 'x_ContactEmail', 'ContactEmail', '`ContactEmail`', '`ContactEmail`', 200, -1, FALSE, '`ContactEmail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ContactEmail->Sortable = TRUE; // Allow sort
		$this->fields['ContactEmail'] = &$this->ContactEmail;

		// ReceiveName
		$this->ReceiveName = new DbField('tbl_contact', 'tbl_contact', 'x_ReceiveName', 'ReceiveName', '`ReceiveName`', '`ReceiveName`', 200, -1, FALSE, '`ReceiveName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReceiveName->Sortable = TRUE; // Allow sort
		$this->fields['ReceiveName'] = &$this->ReceiveName;

		// ReceiveTime
		$this->ReceiveTime = new DbField('tbl_contact', 'tbl_contact', 'x_ReceiveTime', 'ReceiveTime', '`ReceiveTime`', '`ReceiveTime`', 200, -1, FALSE, '`ReceiveTime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ReceiveTime->Sortable = TRUE; // Allow sort
		$this->fields['ReceiveTime'] = &$this->ReceiveTime;

		// Note
		$this->Note = new DbField('tbl_contact', 'tbl_contact', 'x_Note', 'Note', '`Note`', '`Note`', 200, -1, FALSE, '`Note`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Note->Sortable = TRUE; // Allow sort
		$this->fields['Note'] = &$this->Note;

		// CreateUser
		$this->CreateUser = new DbField('tbl_contact', 'tbl_contact', 'x_CreateUser', 'CreateUser', '`CreateUser`', '`CreateUser`', 200, -1, FALSE, '`CreateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateUser->Sortable = TRUE; // Allow sort
		$this->fields['CreateUser'] = &$this->CreateUser;

		// CreateDate
		$this->CreateDate = new DbField('tbl_contact', 'tbl_contact', 'x_CreateDate', 'CreateDate', '`CreateDate`', CastDateFieldForLike('`CreateDate`', 11, "DB"), 135, 11, FALSE, '`CreateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateDate->Sortable = TRUE; // Allow sort
		$this->CreateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['CreateDate'] = &$this->CreateDate;

		// UpdateUser
		$this->UpdateUser = new DbField('tbl_contact', 'tbl_contact', 'x_UpdateUser', 'UpdateUser', '`UpdateUser`', '`UpdateUser`', 200, -1, FALSE, '`UpdateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateUser->Sortable = FALSE; // Allow sort
		$this->fields['UpdateUser'] = &$this->UpdateUser;

		// UpdateDate
		$this->UpdateDate = new DbField('tbl_contact', 'tbl_contact', 'x_UpdateDate', 'UpdateDate', '`UpdateDate`', CastDateFieldForLike('`UpdateDate`', 11, "DB"), 135, 11, FALSE, '`UpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateDate->Sortable = FALSE; // Allow sort
		$this->UpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['UpdateDate'] = &$this->UpdateDate;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`tbl_contact`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->ID_Contact->setDbValue($conn->insert_ID());
			$rs['ID_Contact'] = $this->ID_Contact->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ID_Contact';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID_Contact', $rs))
				AddFilter($where, QuotedName('ID_Contact', $this->Dbid) . '=' . QuotedValue($rs['ID_Contact'], $this->ID_Contact->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ID_Contact->DbValue = $row['ID_Contact'];
		$this->CodeContact->DbValue = $row['CodeContact'];
		$this->ContactType->DbValue = $row['ContactType'];
		$this->ContactName->DbValue = $row['ContactName'];
		$this->CompanyName->DbValue = $row['CompanyName'];
		$this->Address->DbValue = $row['Address'];
		$this->ContactPhone->DbValue = $row['ContactPhone'];
		$this->ContactEmail->DbValue = $row['ContactEmail'];
		$this->ReceiveName->DbValue = $row['ReceiveName'];
		$this->ReceiveTime->DbValue = $row['ReceiveTime'];
		$this->Note->DbValue = $row['Note'];
		$this->CreateUser->DbValue = $row['CreateUser'];
		$this->CreateDate->DbValue = $row['CreateDate'];
		$this->UpdateUser->DbValue = $row['UpdateUser'];
		$this->UpdateDate->DbValue = $row['UpdateDate'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Contact` = @ID_Contact@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_Contact', $row) ? $row['ID_Contact'] : NULL) : $this->ID_Contact->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Contact@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "tbl_contactlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "tbl_contactview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_contactedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_contactadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_contactlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_contactview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_contactview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "tbl_contactadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_contactadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_contactedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_contactadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("tbl_contactdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Contact:" . JsonEncode($this->ID_Contact->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->ID_Contact->CurrentValue != NULL) {
			$url .= "ID_Contact=" . urlencode($this->ID_Contact->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("ID_Contact") !== NULL)
				$arKeys[] = Param("ID_Contact");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->ID_Contact->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->ID_Contact->setDbValue($rs->fields('ID_Contact'));
		$this->CodeContact->setDbValue($rs->fields('CodeContact'));
		$this->ContactType->setDbValue($rs->fields('ContactType'));
		$this->ContactName->setDbValue($rs->fields('ContactName'));
		$this->CompanyName->setDbValue($rs->fields('CompanyName'));
		$this->Address->setDbValue($rs->fields('Address'));
		$this->ContactPhone->setDbValue($rs->fields('ContactPhone'));
		$this->ContactEmail->setDbValue($rs->fields('ContactEmail'));
		$this->ReceiveName->setDbValue($rs->fields('ReceiveName'));
		$this->ReceiveTime->setDbValue($rs->fields('ReceiveTime'));
		$this->Note->setDbValue($rs->fields('Note'));
		$this->CreateUser->setDbValue($rs->fields('CreateUser'));
		$this->CreateDate->setDbValue($rs->fields('CreateDate'));
		$this->UpdateUser->setDbValue($rs->fields('UpdateUser'));
		$this->UpdateDate->setDbValue($rs->fields('UpdateDate'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Contact

		$this->ID_Contact->CellCssStyle = "white-space: nowrap;";

		// CodeContact
		$this->CodeContact->CellCssStyle = "white-space: nowrap;";

		// ContactType
		$this->ContactType->CellCssStyle = "white-space: nowrap;";

		// ContactName
		$this->ContactName->CellCssStyle = "white-space: nowrap;";

		// CompanyName
		$this->CompanyName->CellCssStyle = "white-space: nowrap;";

		// Address
		$this->Address->CellCssStyle = "white-space: nowrap;";

		// ContactPhone
		$this->ContactPhone->CellCssStyle = "white-space: nowrap;";

		// ContactEmail
		$this->ContactEmail->CellCssStyle = "white-space: nowrap;";

		// ReceiveName
		$this->ReceiveName->CellCssStyle = "white-space: nowrap;";

		// ReceiveTime
		$this->ReceiveTime->CellCssStyle = "white-space: nowrap;";

		// Note
		$this->Note->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// ID_Contact
		$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
		$this->ID_Contact->ViewCustomAttributes = "";

		// CodeContact
		$this->CodeContact->ViewValue = $this->CodeContact->CurrentValue;
		$this->CodeContact->ViewCustomAttributes = "";

		// ContactType
		if (strval($this->ContactType->CurrentValue) <> "") {
			$this->ContactType->ViewValue = $this->ContactType->optionCaption($this->ContactType->CurrentValue);
		} else {
			$this->ContactType->ViewValue = NULL;
		}
		$this->ContactType->ViewCustomAttributes = "";

		// ContactName
		$this->ContactName->ViewValue = $this->ContactName->CurrentValue;
		$this->ContactName->ViewCustomAttributes = "";

		// CompanyName
		$this->CompanyName->ViewValue = $this->CompanyName->CurrentValue;
		$this->CompanyName->ViewCustomAttributes = "";

		// Address
		$this->Address->ViewValue = $this->Address->CurrentValue;
		$this->Address->ViewCustomAttributes = "";

		// ContactPhone
		$this->ContactPhone->ViewValue = $this->ContactPhone->CurrentValue;
		$this->ContactPhone->ViewCustomAttributes = "";

		// ContactEmail
		$this->ContactEmail->ViewValue = $this->ContactEmail->CurrentValue;
		$this->ContactEmail->ViewCustomAttributes = "";

		// ReceiveName
		$this->ReceiveName->ViewValue = $this->ReceiveName->CurrentValue;
		$this->ReceiveName->ViewCustomAttributes = "";

		// ReceiveTime
		$this->ReceiveTime->ViewValue = $this->ReceiveTime->CurrentValue;
		$this->ReceiveTime->ViewCustomAttributes = "";

		// Note
		$this->Note->ViewValue = $this->Note->CurrentValue;
		$this->Note->ViewCustomAttributes = "";

		// CreateUser
		$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
		$this->CreateDate->ViewCustomAttributes = "";

		// UpdateUser
		$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->ViewCustomAttributes = "";

		// UpdateDate
		$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
		$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 11);
		$this->UpdateDate->ViewCustomAttributes = "";

		// ID_Contact
		$this->ID_Contact->LinkCustomAttributes = "";
		$this->ID_Contact->HrefValue = "";
		$this->ID_Contact->TooltipValue = "";

		// CodeContact
		$this->CodeContact->LinkCustomAttributes = "";
		$this->CodeContact->HrefValue = "";
		$this->CodeContact->TooltipValue = "";

		// ContactType
		$this->ContactType->LinkCustomAttributes = "";
		$this->ContactType->HrefValue = "";
		$this->ContactType->TooltipValue = "";

		// ContactName
		$this->ContactName->LinkCustomAttributes = "";
		$this->ContactName->HrefValue = "";
		$this->ContactName->TooltipValue = "";

		// CompanyName
		$this->CompanyName->LinkCustomAttributes = "";
		$this->CompanyName->HrefValue = "";
		$this->CompanyName->TooltipValue = "";

		// Address
		$this->Address->LinkCustomAttributes = "";
		$this->Address->HrefValue = "";
		$this->Address->TooltipValue = "";

		// ContactPhone
		$this->ContactPhone->LinkCustomAttributes = "";
		$this->ContactPhone->HrefValue = "";
		$this->ContactPhone->TooltipValue = "";

		// ContactEmail
		$this->ContactEmail->LinkCustomAttributes = "";
		$this->ContactEmail->HrefValue = "";
		$this->ContactEmail->TooltipValue = "";

		// ReceiveName
		$this->ReceiveName->LinkCustomAttributes = "";
		$this->ReceiveName->HrefValue = "";
		$this->ReceiveName->TooltipValue = "";

		// ReceiveTime
		$this->ReceiveTime->LinkCustomAttributes = "";
		$this->ReceiveTime->HrefValue = "";
		$this->ReceiveTime->TooltipValue = "";

		// Note
		$this->Note->LinkCustomAttributes = "";
		$this->Note->HrefValue = "";
		$this->Note->TooltipValue = "";

		// CreateUser
		$this->CreateUser->LinkCustomAttributes = "";
		$this->CreateUser->HrefValue = "";
		$this->CreateUser->TooltipValue = "";

		// CreateDate
		$this->CreateDate->LinkCustomAttributes = "";
		$this->CreateDate->HrefValue = "";
		$this->CreateDate->TooltipValue = "";

		// UpdateUser
		$this->UpdateUser->LinkCustomAttributes = "";
		$this->UpdateUser->HrefValue = "";
		$this->UpdateUser->TooltipValue = "";

		// UpdateDate
		$this->UpdateDate->LinkCustomAttributes = "";
		$this->UpdateDate->HrefValue = "";
		$this->UpdateDate->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ID_Contact
		$this->ID_Contact->EditAttrs["class"] = "form-control";
		$this->ID_Contact->EditCustomAttributes = "";
		$this->ID_Contact->EditValue = $this->ID_Contact->CurrentValue;
		$this->ID_Contact->ViewCustomAttributes = "";

		// CodeContact
		$this->CodeContact->EditAttrs["class"] = "form-control";
		$this->CodeContact->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CodeContact->CurrentValue = HtmlDecode($this->CodeContact->CurrentValue);
		$this->CodeContact->EditValue = $this->CodeContact->CurrentValue;
		$this->CodeContact->PlaceHolder = RemoveHtml($this->CodeContact->caption());

		// ContactType
		$this->ContactType->EditAttrs["class"] = "form-control";
		$this->ContactType->EditCustomAttributes = "";
		$this->ContactType->EditValue = $this->ContactType->options(TRUE);

		// ContactName
		$this->ContactName->EditAttrs["class"] = "form-control";
		$this->ContactName->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->ContactName->CurrentValue = HtmlDecode($this->ContactName->CurrentValue);
		$this->ContactName->EditValue = $this->ContactName->CurrentValue;
		$this->ContactName->PlaceHolder = RemoveHtml($this->ContactName->caption());

		// CompanyName
		$this->CompanyName->EditAttrs["class"] = "form-control";
		$this->CompanyName->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CompanyName->CurrentValue = HtmlDecode($this->CompanyName->CurrentValue);
		$this->CompanyName->EditValue = $this->CompanyName->CurrentValue;
		$this->CompanyName->PlaceHolder = RemoveHtml($this->CompanyName->caption());

		// Address
		$this->Address->EditAttrs["class"] = "form-control";
		$this->Address->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
		$this->Address->EditValue = $this->Address->CurrentValue;
		$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

		// ContactPhone
		$this->ContactPhone->EditAttrs["class"] = "form-control";
		$this->ContactPhone->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->ContactPhone->CurrentValue = HtmlDecode($this->ContactPhone->CurrentValue);
		$this->ContactPhone->EditValue = $this->ContactPhone->CurrentValue;
		$this->ContactPhone->PlaceHolder = RemoveHtml($this->ContactPhone->caption());

		// ContactEmail
		$this->ContactEmail->EditAttrs["class"] = "form-control";
		$this->ContactEmail->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->ContactEmail->CurrentValue = HtmlDecode($this->ContactEmail->CurrentValue);
		$this->ContactEmail->EditValue = $this->ContactEmail->CurrentValue;
		$this->ContactEmail->PlaceHolder = RemoveHtml($this->ContactEmail->caption());

		// ReceiveName
		$this->ReceiveName->EditAttrs["class"] = "form-control";
		$this->ReceiveName->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->ReceiveName->CurrentValue = HtmlDecode($this->ReceiveName->CurrentValue);
		$this->ReceiveName->EditValue = $this->ReceiveName->CurrentValue;
		$this->ReceiveName->PlaceHolder = RemoveHtml($this->ReceiveName->caption());

		// ReceiveTime
		$this->ReceiveTime->EditAttrs["class"] = "form-control";
		$this->ReceiveTime->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->ReceiveTime->CurrentValue = HtmlDecode($this->ReceiveTime->CurrentValue);
		$this->ReceiveTime->EditValue = $this->ReceiveTime->CurrentValue;
		$this->ReceiveTime->PlaceHolder = RemoveHtml($this->ReceiveTime->caption());

		// Note
		$this->Note->EditAttrs["class"] = "form-control";
		$this->Note->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Note->CurrentValue = HtmlDecode($this->Note->CurrentValue);
		$this->Note->EditValue = $this->Note->CurrentValue;
		$this->Note->PlaceHolder = RemoveHtml($this->Note->caption());

		// CreateUser
		$this->CreateUser->EditAttrs["class"] = "form-control";
		$this->CreateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CreateUser->CurrentValue = HtmlDecode($this->CreateUser->CurrentValue);
		$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->PlaceHolder = RemoveHtml($this->CreateUser->caption());

		// CreateDate
		$this->CreateDate->EditAttrs["class"] = "form-control";
		$this->CreateDate->EditCustomAttributes = "";
		$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->CurrentValue, 11);
		$this->CreateDate->PlaceHolder = RemoveHtml($this->CreateDate->caption());

		// UpdateUser
		$this->UpdateUser->EditAttrs["class"] = "form-control";
		$this->UpdateUser->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UpdateUser->CurrentValue = HtmlDecode($this->UpdateUser->CurrentValue);
		$this->UpdateUser->EditValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->PlaceHolder = RemoveHtml($this->UpdateUser->caption());

		// UpdateDate
		$this->UpdateDate->EditAttrs["class"] = "form-control";
		$this->UpdateDate->EditCustomAttributes = "";
		$this->UpdateDate->EditValue = FormatDateTime($this->UpdateDate->CurrentValue, 11);
		$this->UpdateDate->PlaceHolder = RemoveHtml($this->UpdateDate->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->CodeContact);
					$doc->exportCaption($this->ContactType);
					$doc->exportCaption($this->ContactName);
					$doc->exportCaption($this->CompanyName);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->ContactPhone);
					$doc->exportCaption($this->ContactEmail);
					$doc->exportCaption($this->ReceiveName);
					$doc->exportCaption($this->ReceiveTime);
					$doc->exportCaption($this->Note);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
				} else {
					$doc->exportCaption($this->CodeContact);
					$doc->exportCaption($this->ContactType);
					$doc->exportCaption($this->ContactName);
					$doc->exportCaption($this->CompanyName);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->ContactPhone);
					$doc->exportCaption($this->ContactEmail);
					$doc->exportCaption($this->ReceiveName);
					$doc->exportCaption($this->ReceiveTime);
					$doc->exportCaption($this->Note);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->CodeContact);
						$doc->exportField($this->ContactType);
						$doc->exportField($this->ContactName);
						$doc->exportField($this->CompanyName);
						$doc->exportField($this->Address);
						$doc->exportField($this->ContactPhone);
						$doc->exportField($this->ContactEmail);
						$doc->exportField($this->ReceiveName);
						$doc->exportField($this->ReceiveTime);
						$doc->exportField($this->Note);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
					} else {
						$doc->exportField($this->CodeContact);
						$doc->exportField($this->ContactType);
						$doc->exportField($this->ContactName);
						$doc->exportField($this->CompanyName);
						$doc->exportField($this->Address);
						$doc->exportField($this->ContactPhone);
						$doc->exportField($this->ContactEmail);
						$doc->exportField($this->ReceiveName);
						$doc->exportField($this->ReceiveTime);
						$doc->exportField($this->Note);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'tbl_contact';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_contact';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Contact'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'tbl_contact';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['ID_Contact'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'tbl_contact';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Contact'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>