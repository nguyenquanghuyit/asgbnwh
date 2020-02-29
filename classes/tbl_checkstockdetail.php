<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for tbl_checkstockdetail
 */
class tbl_checkstockdetail extends DbTable
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
	public $ID;
	public $ID_checkStock;
	public $Location;
	public $PalletID;
	public $Code;
	public $PCS;
	public $DateTimeCheck;
	public $UserCheck;
	public $Usercreate;
	public $DatetimeCreate;
	public $UserUpdate;
	public $Datetimeupdate;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_checkstockdetail';
		$this->TableName = 'tbl_checkstockdetail';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_checkstockdetail`";
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
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ID
		$this->ID = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_ID', 'ID', '`ID`', '`ID`', 3, -1, FALSE, '`ID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Sortable = FALSE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// ID_checkStock
		$this->ID_checkStock = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_ID_checkStock', 'ID_checkStock', '`ID_checkStock`', '`ID_checkStock`', 3, -1, FALSE, '`ID_checkStock`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_checkStock->IsForeignKey = TRUE; // Foreign key field
		$this->ID_checkStock->Nullable = FALSE; // NOT NULL field
		$this->ID_checkStock->Required = TRUE; // Required field
		$this->ID_checkStock->Sortable = FALSE; // Allow sort
		$this->ID_checkStock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_checkStock'] = &$this->ID_checkStock;

		// Location
		$this->Location = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_Location', 'Location', '`Location`', '`Location`', 200, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Location->Nullable = FALSE; // NOT NULL field
		$this->Location->Required = TRUE; // Required field
		$this->Location->Sortable = TRUE; // Allow sort
		$this->fields['Location'] = &$this->Location;

		// PalletID
		$this->PalletID = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_PalletID', 'PalletID', '`PalletID`', '`PalletID`', 200, -1, FALSE, '`PalletID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PalletID->Sortable = TRUE; // Allow sort
		$this->fields['PalletID'] = &$this->PalletID;

		// Code
		$this->Code = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_Code', 'Code', '`Code`', '`Code`', 200, -1, FALSE, '`Code`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Code->Sortable = TRUE; // Allow sort
		$this->fields['Code'] = &$this->Code;

		// PCS
		$this->PCS = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_PCS', 'PCS', '`PCS`', '`PCS`', 3, -1, FALSE, '`PCS`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PCS->Nullable = FALSE; // NOT NULL field
		$this->PCS->Required = TRUE; // Required field
		$this->PCS->Sortable = TRUE; // Allow sort
		$this->PCS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PCS'] = &$this->PCS;

		// DateTimeCheck
		$this->DateTimeCheck = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_DateTimeCheck', 'DateTimeCheck', '`DateTimeCheck`', CastDateFieldForLike('`DateTimeCheck`', 0, "DB"), 135, 0, FALSE, '`DateTimeCheck`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateTimeCheck->Nullable = FALSE; // NOT NULL field
		$this->DateTimeCheck->Required = TRUE; // Required field
		$this->DateTimeCheck->Sortable = TRUE; // Allow sort
		$this->DateTimeCheck->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateTimeCheck'] = &$this->DateTimeCheck;

		// UserCheck
		$this->UserCheck = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_UserCheck', 'UserCheck', '`UserCheck`', '`UserCheck`', 200, -1, FALSE, '`UserCheck`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UserCheck->Nullable = FALSE; // NOT NULL field
		$this->UserCheck->Required = TRUE; // Required field
		$this->UserCheck->Sortable = TRUE; // Allow sort
		$this->fields['UserCheck'] = &$this->UserCheck;

		// Usercreate
		$this->Usercreate = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_Usercreate', 'Usercreate', '`Usercreate`', '`Usercreate`', 200, -1, FALSE, '`Usercreate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Usercreate->Sortable = TRUE; // Allow sort
		$this->fields['Usercreate'] = &$this->Usercreate;

		// DatetimeCreate
		$this->DatetimeCreate = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_DatetimeCreate', 'DatetimeCreate', '`DatetimeCreate`', CastDateFieldForLike('`DatetimeCreate`', 0, "DB"), 135, 0, FALSE, '`DatetimeCreate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DatetimeCreate->Sortable = TRUE; // Allow sort
		$this->DatetimeCreate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DatetimeCreate'] = &$this->DatetimeCreate;

		// UserUpdate
		$this->UserUpdate = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_UserUpdate', 'UserUpdate', '`UserUpdate`', '`UserUpdate`', 200, -1, FALSE, '`UserUpdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UserUpdate->Sortable = FALSE; // Allow sort
		$this->fields['UserUpdate'] = &$this->UserUpdate;

		// Datetimeupdate
		$this->Datetimeupdate = new DbField('tbl_checkstockdetail', 'tbl_checkstockdetail', 'x_Datetimeupdate', 'Datetimeupdate', '`Datetimeupdate`', CastDateFieldForLike('`Datetimeupdate`', 0, "DB"), 135, 0, FALSE, '`Datetimeupdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Datetimeupdate->Sortable = FALSE; // Allow sort
		$this->Datetimeupdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['Datetimeupdate'] = &$this->Datetimeupdate;
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

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "tbl_checkstock") {
			if ($this->ID_checkStock->getSessionValue() <> "")
				$masterFilter .= "`ID`=" . QuotedValue($this->ID_checkStock->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "tbl_checkstock") {
			if ($this->ID_checkStock->getSessionValue() <> "")
				$detailFilter .= "`ID_checkStock`=" . QuotedValue($this->ID_checkStock->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_tbl_checkstock()
	{
		return "`ID`=@ID@";
	}

	// Detail filter
	public function sqlDetailFilter_tbl_checkstock()
	{
		return "`ID_checkStock`=@ID_checkStock@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`tbl_checkstockdetail`";
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`Code` ASC,`DatetimeCreate` ASC";
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
			$this->ID->setDbValue($conn->insert_ID());
			$rs['ID'] = $this->ID->DbValue;
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
			$fldname = 'ID';
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
			if (array_key_exists('ID', $rs))
				AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
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
		$this->ID->DbValue = $row['ID'];
		$this->ID_checkStock->DbValue = $row['ID_checkStock'];
		$this->Location->DbValue = $row['Location'];
		$this->PalletID->DbValue = $row['PalletID'];
		$this->Code->DbValue = $row['Code'];
		$this->PCS->DbValue = $row['PCS'];
		$this->DateTimeCheck->DbValue = $row['DateTimeCheck'];
		$this->UserCheck->DbValue = $row['UserCheck'];
		$this->Usercreate->DbValue = $row['Usercreate'];
		$this->DatetimeCreate->DbValue = $row['DatetimeCreate'];
		$this->UserUpdate->DbValue = $row['UserUpdate'];
		$this->Datetimeupdate->DbValue = $row['Datetimeupdate'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID` = @ID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID', $row) ? $row['ID'] : NULL) : $this->ID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_checkstockdetaillist.php";
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
		if ($pageName == "tbl_checkstockdetailview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_checkstockdetailedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_checkstockdetailadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_checkstockdetaillist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_checkstockdetailview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_checkstockdetailview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "tbl_checkstockdetailadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_checkstockdetailadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("tbl_checkstockdetailedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("tbl_checkstockdetailadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("tbl_checkstockdetaildelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "tbl_checkstock" && !ContainsString($url, TABLE_SHOW_MASTER . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ID=" . urlencode($this->ID_checkStock->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
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
		if ($this->ID->CurrentValue != NULL) {
			$url .= "ID=" . urlencode($this->ID->CurrentValue);
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
			if (Param("ID") !== NULL)
				$arKeys[] = Param("ID");
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
			$this->ID->CurrentValue = $key;
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
		$this->ID->setDbValue($rs->fields('ID'));
		$this->ID_checkStock->setDbValue($rs->fields('ID_checkStock'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->PalletID->setDbValue($rs->fields('PalletID'));
		$this->Code->setDbValue($rs->fields('Code'));
		$this->PCS->setDbValue($rs->fields('PCS'));
		$this->DateTimeCheck->setDbValue($rs->fields('DateTimeCheck'));
		$this->UserCheck->setDbValue($rs->fields('UserCheck'));
		$this->Usercreate->setDbValue($rs->fields('Usercreate'));
		$this->DatetimeCreate->setDbValue($rs->fields('DatetimeCreate'));
		$this->UserUpdate->setDbValue($rs->fields('UserUpdate'));
		$this->Datetimeupdate->setDbValue($rs->fields('Datetimeupdate'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID

		$this->ID->CellCssStyle = "white-space: nowrap;";

		// ID_checkStock
		$this->ID_checkStock->CellCssStyle = "white-space: nowrap;";

		// Location
		$this->Location->CellCssStyle = "white-space: nowrap;";

		// PalletID
		$this->PalletID->CellCssStyle = "white-space: nowrap;";

		// Code
		$this->Code->CellCssStyle = "white-space: nowrap;";

		// PCS
		$this->PCS->CellCssStyle = "white-space: nowrap;";

		// DateTimeCheck
		$this->DateTimeCheck->CellCssStyle = "white-space: nowrap;";

		// UserCheck
		$this->UserCheck->CellCssStyle = "white-space: nowrap;";

		// Usercreate
		$this->Usercreate->CellCssStyle = "white-space: nowrap;";

		// DatetimeCreate
		$this->DatetimeCreate->CellCssStyle = "white-space: nowrap;";

		// UserUpdate
		$this->UserUpdate->CellCssStyle = "white-space: nowrap;";

		// Datetimeupdate
		$this->Datetimeupdate->CellCssStyle = "white-space: nowrap;";

		// ID
		$this->ID->ViewValue = $this->ID->CurrentValue;
		$this->ID->ViewCustomAttributes = "";

		// ID_checkStock
		$this->ID_checkStock->ViewValue = $this->ID_checkStock->CurrentValue;
		$this->ID_checkStock->ViewValue = FormatNumber($this->ID_checkStock->ViewValue, 0, -2, -2, -2);
		$this->ID_checkStock->ViewCustomAttributes = "";

		// Location
		$this->Location->ViewValue = $this->Location->CurrentValue;
		$this->Location->ViewCustomAttributes = "";

		// PalletID
		$this->PalletID->ViewValue = $this->PalletID->CurrentValue;
		$this->PalletID->ViewCustomAttributes = "";

		// Code
		$this->Code->ViewValue = $this->Code->CurrentValue;
		$this->Code->ViewCustomAttributes = "";

		// PCS
		$this->PCS->ViewValue = $this->PCS->CurrentValue;
		$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
		$this->PCS->CellCssStyle .= "text-align: right;";
		$this->PCS->ViewCustomAttributes = "";

		// DateTimeCheck
		$this->DateTimeCheck->ViewValue = $this->DateTimeCheck->CurrentValue;
		$this->DateTimeCheck->ViewValue = FormatDateTime($this->DateTimeCheck->ViewValue, 0);
		$this->DateTimeCheck->ViewCustomAttributes = "";

		// UserCheck
		$this->UserCheck->ViewValue = $this->UserCheck->CurrentValue;
		$this->UserCheck->ViewCustomAttributes = "";

		// Usercreate
		$this->Usercreate->ViewValue = $this->Usercreate->CurrentValue;
		$this->Usercreate->ViewCustomAttributes = "";

		// DatetimeCreate
		$this->DatetimeCreate->ViewValue = $this->DatetimeCreate->CurrentValue;
		$this->DatetimeCreate->ViewValue = FormatDateTime($this->DatetimeCreate->ViewValue, 0);
		$this->DatetimeCreate->ViewCustomAttributes = "";

		// UserUpdate
		$this->UserUpdate->ViewValue = $this->UserUpdate->CurrentValue;
		$this->UserUpdate->ViewCustomAttributes = "";

		// Datetimeupdate
		$this->Datetimeupdate->ViewValue = $this->Datetimeupdate->CurrentValue;
		$this->Datetimeupdate->ViewValue = FormatDateTime($this->Datetimeupdate->ViewValue, 0);
		$this->Datetimeupdate->ViewCustomAttributes = "";

		// ID
		$this->ID->LinkCustomAttributes = "";
		$this->ID->HrefValue = "";
		$this->ID->TooltipValue = "";

		// ID_checkStock
		$this->ID_checkStock->LinkCustomAttributes = "";
		$this->ID_checkStock->HrefValue = "";
		$this->ID_checkStock->TooltipValue = "";

		// Location
		$this->Location->LinkCustomAttributes = "";
		$this->Location->HrefValue = "";
		$this->Location->TooltipValue = "";

		// PalletID
		$this->PalletID->LinkCustomAttributes = "";
		$this->PalletID->HrefValue = "";
		$this->PalletID->TooltipValue = "";

		// Code
		$this->Code->LinkCustomAttributes = "";
		$this->Code->HrefValue = "";
		$this->Code->TooltipValue = "";

		// PCS
		$this->PCS->LinkCustomAttributes = "";
		$this->PCS->HrefValue = "";
		$this->PCS->TooltipValue = "";

		// DateTimeCheck
		$this->DateTimeCheck->LinkCustomAttributes = "";
		$this->DateTimeCheck->HrefValue = "";
		$this->DateTimeCheck->TooltipValue = "";

		// UserCheck
		$this->UserCheck->LinkCustomAttributes = "";
		$this->UserCheck->HrefValue = "";
		$this->UserCheck->TooltipValue = "";

		// Usercreate
		$this->Usercreate->LinkCustomAttributes = "";
		$this->Usercreate->HrefValue = "";
		$this->Usercreate->TooltipValue = "";

		// DatetimeCreate
		$this->DatetimeCreate->LinkCustomAttributes = "";
		$this->DatetimeCreate->HrefValue = "";
		$this->DatetimeCreate->TooltipValue = "";

		// UserUpdate
		$this->UserUpdate->LinkCustomAttributes = "";
		$this->UserUpdate->HrefValue = "";
		$this->UserUpdate->TooltipValue = "";

		// Datetimeupdate
		$this->Datetimeupdate->LinkCustomAttributes = "";
		$this->Datetimeupdate->HrefValue = "";
		$this->Datetimeupdate->TooltipValue = "";

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

		// ID
		$this->ID->EditAttrs["class"] = "form-control";
		$this->ID->EditCustomAttributes = "";
		$this->ID->EditValue = $this->ID->CurrentValue;
		$this->ID->ViewCustomAttributes = "";

		// ID_checkStock
		$this->ID_checkStock->EditAttrs["class"] = "form-control";
		$this->ID_checkStock->EditCustomAttributes = "";
		if ($this->ID_checkStock->getSessionValue() <> "") {
			$this->ID_checkStock->CurrentValue = $this->ID_checkStock->getSessionValue();
		$this->ID_checkStock->ViewValue = $this->ID_checkStock->CurrentValue;
		$this->ID_checkStock->ViewValue = FormatNumber($this->ID_checkStock->ViewValue, 0, -2, -2, -2);
		$this->ID_checkStock->ViewCustomAttributes = "";
		} else {
		$this->ID_checkStock->EditValue = $this->ID_checkStock->CurrentValue;
		$this->ID_checkStock->PlaceHolder = RemoveHtml($this->ID_checkStock->caption());
		}

		// Location
		$this->Location->EditAttrs["class"] = "form-control";
		$this->Location->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
		$this->Location->EditValue = $this->Location->CurrentValue;
		$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

		// PalletID
		$this->PalletID->EditAttrs["class"] = "form-control";
		$this->PalletID->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->PalletID->CurrentValue = HtmlDecode($this->PalletID->CurrentValue);
		$this->PalletID->EditValue = $this->PalletID->CurrentValue;
		$this->PalletID->PlaceHolder = RemoveHtml($this->PalletID->caption());

		// Code
		$this->Code->EditAttrs["class"] = "form-control";
		$this->Code->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Code->CurrentValue = HtmlDecode($this->Code->CurrentValue);
		$this->Code->EditValue = $this->Code->CurrentValue;
		$this->Code->PlaceHolder = RemoveHtml($this->Code->caption());

		// PCS
		$this->PCS->EditAttrs["class"] = "form-control";
		$this->PCS->EditCustomAttributes = "";
		$this->PCS->EditValue = $this->PCS->CurrentValue;
		$this->PCS->PlaceHolder = RemoveHtml($this->PCS->caption());

		// DateTimeCheck
		$this->DateTimeCheck->EditAttrs["class"] = "form-control";
		$this->DateTimeCheck->EditCustomAttributes = "";
		$this->DateTimeCheck->EditValue = FormatDateTime($this->DateTimeCheck->CurrentValue, 8);
		$this->DateTimeCheck->PlaceHolder = RemoveHtml($this->DateTimeCheck->caption());

		// UserCheck
		$this->UserCheck->EditAttrs["class"] = "form-control";
		$this->UserCheck->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UserCheck->CurrentValue = HtmlDecode($this->UserCheck->CurrentValue);
		$this->UserCheck->EditValue = $this->UserCheck->CurrentValue;
		$this->UserCheck->PlaceHolder = RemoveHtml($this->UserCheck->caption());

		// Usercreate
		$this->Usercreate->EditAttrs["class"] = "form-control";
		$this->Usercreate->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Usercreate->CurrentValue = HtmlDecode($this->Usercreate->CurrentValue);
		$this->Usercreate->EditValue = $this->Usercreate->CurrentValue;
		$this->Usercreate->PlaceHolder = RemoveHtml($this->Usercreate->caption());

		// DatetimeCreate
		$this->DatetimeCreate->EditAttrs["class"] = "form-control";
		$this->DatetimeCreate->EditCustomAttributes = "";
		$this->DatetimeCreate->EditValue = FormatDateTime($this->DatetimeCreate->CurrentValue, 8);
		$this->DatetimeCreate->PlaceHolder = RemoveHtml($this->DatetimeCreate->caption());

		// UserUpdate
		$this->UserUpdate->EditAttrs["class"] = "form-control";
		$this->UserUpdate->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UserUpdate->CurrentValue = HtmlDecode($this->UserUpdate->CurrentValue);
		$this->UserUpdate->EditValue = $this->UserUpdate->CurrentValue;
		$this->UserUpdate->PlaceHolder = RemoveHtml($this->UserUpdate->caption());

		// Datetimeupdate
		$this->Datetimeupdate->EditAttrs["class"] = "form-control";
		$this->Datetimeupdate->EditCustomAttributes = "";
		$this->Datetimeupdate->EditValue = FormatDateTime($this->Datetimeupdate->CurrentValue, 8);
		$this->Datetimeupdate->PlaceHolder = RemoveHtml($this->Datetimeupdate->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->PCS->CurrentValue))
				$this->PCS->Total += $this->PCS->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->PCS->CurrentValue = $this->PCS->Total;
			$this->PCS->ViewValue = $this->PCS->CurrentValue;
			$this->PCS->ViewValue = FormatNumber($this->PCS->ViewValue, 0, -2, -2, -2);
			$this->PCS->CellCssStyle .= "text-align: right;";
			$this->PCS->ViewCustomAttributes = "";
			$this->PCS->HrefValue = ""; // Clear href value

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
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PalletID);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->DateTimeCheck);
					$doc->exportCaption($this->UserCheck);
					$doc->exportCaption($this->Usercreate);
					$doc->exportCaption($this->DatetimeCreate);
				} else {
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->PalletID);
					$doc->exportCaption($this->Code);
					$doc->exportCaption($this->PCS);
					$doc->exportCaption($this->DateTimeCheck);
					$doc->exportCaption($this->UserCheck);
					$doc->exportCaption($this->Usercreate);
					$doc->exportCaption($this->DatetimeCreate);
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
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->Location);
						$doc->exportField($this->PalletID);
						$doc->exportField($this->Code);
						$doc->exportField($this->PCS);
						$doc->exportField($this->DateTimeCheck);
						$doc->exportField($this->UserCheck);
						$doc->exportField($this->Usercreate);
						$doc->exportField($this->DatetimeCreate);
					} else {
						$doc->exportField($this->Location);
						$doc->exportField($this->PalletID);
						$doc->exportField($this->Code);
						$doc->exportField($this->PCS);
						$doc->exportField($this->DateTimeCheck);
						$doc->exportField($this->UserCheck);
						$doc->exportField($this->Usercreate);
						$doc->exportField($this->DatetimeCreate);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->Location, '');
				$doc->exportAggregate($this->PalletID, '');
				$doc->exportAggregate($this->Code, '');
				$doc->exportAggregate($this->PCS, 'TOTAL');
				$doc->exportAggregate($this->DateTimeCheck, '');
				$doc->exportAggregate($this->UserCheck, '');
				$doc->exportAggregate($this->Usercreate, '');
				$doc->exportAggregate($this->DatetimeCreate, '');
				$doc->endExportRow();
			}
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
		$table = 'tbl_checkstockdetail';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_checkstockdetail';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID'];

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
		$table = 'tbl_checkstockdetail';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['ID'];

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
		$table = 'tbl_checkstockdetail';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID'];

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