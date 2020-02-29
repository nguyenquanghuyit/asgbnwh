<?php
namespace PHPMaker2019\asgbn_wh;

/**
 * Table class for tbl_order
 */
class tbl_order extends DbTable
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
	public $ID_Order;
	public $OrderDate;
	public $InvoiceNo;
	public $CusomterOrderNo;
	public $IdType;
	public $ID_Contact;
	public $CreateUser;
	public $CreateDate;
	public $StatusLoad;
	public $StatusFinishOrder;
	public $DateTimefinishOrder;
	public $UserFinishOrder;
	public $UpdateDate;
	public $UpdateUser;
	public $PrintSubLable;
	public $Packing;
	public $FinishPacking;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'tbl_order';
		$this->TableName = 'tbl_order';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_order`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// ID_Order
		$this->ID_Order = new DbField('tbl_order', 'tbl_order', 'x_ID_Order', 'ID_Order', '`ID_Order`', '`ID_Order`', 3, -1, FALSE, '`ID_Order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID_Order->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID_Order->IsPrimaryKey = TRUE; // Primary key field
		$this->ID_Order->IsForeignKey = TRUE; // Foreign key field
		$this->ID_Order->Sortable = TRUE; // Allow sort
		$this->ID_Order->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Order'] = &$this->ID_Order;

		// OrderDate
		$this->OrderDate = new DbField('tbl_order', 'tbl_order', 'x_OrderDate', 'OrderDate', '`OrderDate`', CastDateFieldForLike('`OrderDate`', 7, "DB"), 135, 7, FALSE, '`OrderDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OrderDate->Required = TRUE; // Required field
		$this->OrderDate->Sortable = TRUE; // Allow sort
		$this->OrderDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['OrderDate'] = &$this->OrderDate;

		// InvoiceNo
		$this->InvoiceNo = new DbField('tbl_order', 'tbl_order', 'x_InvoiceNo', 'InvoiceNo', '`InvoiceNo`', '`InvoiceNo`', 200, -1, FALSE, '`InvoiceNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->InvoiceNo->Sortable = TRUE; // Allow sort
		$this->fields['InvoiceNo'] = &$this->InvoiceNo;

		// CusomterOrderNo
		$this->CusomterOrderNo = new DbField('tbl_order', 'tbl_order', 'x_CusomterOrderNo', 'CusomterOrderNo', '`CusomterOrderNo`', '`CusomterOrderNo`', 200, -1, FALSE, '`CusomterOrderNo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CusomterOrderNo->Sortable = TRUE; // Allow sort
		$this->fields['CusomterOrderNo'] = &$this->CusomterOrderNo;

		// IdType
		$this->IdType = new DbField('tbl_order', 'tbl_order', 'x_IdType', 'IdType', '`IdType`', '`IdType`', 200, -1, FALSE, '`IdType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->IdType->Required = TRUE; // Required field
		$this->IdType->Sortable = TRUE; // Allow sort
		$this->IdType->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->IdType->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->IdType->Lookup = new Lookup('IdType', 'tbl_producttype', FALSE, 'IdType', ["TypeName","","",""], [], [], [], [], [], [], '', '');
		$this->fields['IdType'] = &$this->IdType;

		// ID_Contact
		$this->ID_Contact = new DbField('tbl_order', 'tbl_order', 'x_ID_Contact', 'ID_Contact', '`ID_Contact`', '`ID_Contact`', 3, -1, FALSE, '`EV__ID_Contact`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Contact->Required = TRUE; // Required field
		$this->ID_Contact->Sortable = TRUE; // Allow sort
		$this->ID_Contact->Lookup = new Lookup('ID_Contact', 'tbl_contact', FALSE, 'ID_Contact', ["CodeContact","ContactName","",""], [], [], [], [], [], [], '', '');
		$this->ID_Contact->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Contact'] = &$this->ID_Contact;

		// CreateUser
		$this->CreateUser = new DbField('tbl_order', 'tbl_order', 'x_CreateUser', 'CreateUser', '`CreateUser`', '`CreateUser`', 200, -1, FALSE, '`CreateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateUser->Sortable = TRUE; // Allow sort
		$this->fields['CreateUser'] = &$this->CreateUser;

		// CreateDate
		$this->CreateDate = new DbField('tbl_order', 'tbl_order', 'x_CreateDate', 'CreateDate', '`CreateDate`', CastDateFieldForLike('`CreateDate`', 11, "DB"), 135, 11, FALSE, '`CreateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreateDate->Sortable = TRUE; // Allow sort
		$this->CreateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['CreateDate'] = &$this->CreateDate;

		// StatusLoad
		$this->StatusLoad = new DbField('tbl_order', 'tbl_order', 'x_StatusLoad', 'StatusLoad', '`StatusLoad`', '`StatusLoad`', 16, -1, FALSE, '`StatusLoad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->StatusLoad->Required = TRUE; // Required field
		$this->StatusLoad->Sortable = TRUE; // Allow sort
		$this->StatusLoad->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->StatusLoad->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->StatusLoad->Lookup = new Lookup('StatusLoad', 'tbl_order', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->StatusLoad->OptionCount = 2;
		$this->StatusLoad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['StatusLoad'] = &$this->StatusLoad;

		// StatusFinishOrder
		$this->StatusFinishOrder = new DbField('tbl_order', 'tbl_order', 'x_StatusFinishOrder', 'StatusFinishOrder', '`StatusFinishOrder`', '`StatusFinishOrder`', 16, -1, FALSE, '`StatusFinishOrder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->StatusFinishOrder->Sortable = TRUE; // Allow sort
		$this->StatusFinishOrder->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->StatusFinishOrder->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->StatusFinishOrder->Lookup = new Lookup('StatusFinishOrder', 'tbl_order', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->StatusFinishOrder->OptionCount = 2;
		$this->fields['StatusFinishOrder'] = &$this->StatusFinishOrder;

		// DateTimefinishOrder
		$this->DateTimefinishOrder = new DbField('tbl_order', 'tbl_order', 'x_DateTimefinishOrder', 'DateTimefinishOrder', '`DateTimefinishOrder`', CastDateFieldForLike('`DateTimefinishOrder`', 0, "DB"), 135, 0, FALSE, '`DateTimefinishOrder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateTimefinishOrder->Sortable = FALSE; // Allow sort
		$this->DateTimefinishOrder->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateTimefinishOrder'] = &$this->DateTimefinishOrder;

		// UserFinishOrder
		$this->UserFinishOrder = new DbField('tbl_order', 'tbl_order', 'x_UserFinishOrder', 'UserFinishOrder', '`UserFinishOrder`', '`UserFinishOrder`', 200, -1, FALSE, '`UserFinishOrder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UserFinishOrder->Sortable = FALSE; // Allow sort
		$this->fields['UserFinishOrder'] = &$this->UserFinishOrder;

		// UpdateDate
		$this->UpdateDate = new DbField('tbl_order', 'tbl_order', 'x_UpdateDate', 'UpdateDate', '`UpdateDate`', CastDateFieldForLike('`UpdateDate`', 0, "DB"), 135, 0, FALSE, '`UpdateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateDate->Sortable = FALSE; // Allow sort
		$this->UpdateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['UpdateDate'] = &$this->UpdateDate;

		// UpdateUser
		$this->UpdateUser = new DbField('tbl_order', 'tbl_order', 'x_UpdateUser', 'UpdateUser', '`UpdateUser`', '`UpdateUser`', 200, -1, FALSE, '`UpdateUser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->UpdateUser->Sortable = FALSE; // Allow sort
		$this->fields['UpdateUser'] = &$this->UpdateUser;

		// PrintSubLable
		$this->PrintSubLable = new DbField('tbl_order', 'tbl_order', 'x_PrintSubLable', 'PrintSubLable', '`PrintSubLable`', '`PrintSubLable`', 16, -1, FALSE, '`PrintSubLable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PrintSubLable->Sortable = TRUE; // Allow sort
		$this->fields['PrintSubLable'] = &$this->PrintSubLable;

		// Packing
		$this->Packing = new DbField('tbl_order', 'tbl_order', 'x_Packing', 'Packing', '`Packing`', '`Packing`', 16, -1, FALSE, '`Packing`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Packing->Sortable = TRUE; // Allow sort
		$this->fields['Packing'] = &$this->Packing;

		// FinishPacking
		$this->FinishPacking = new DbField('tbl_order', 'tbl_order', 'x_FinishPacking', 'FinishPacking', '`FinishPacking`', '`FinishPacking`', 16, -1, FALSE, '`FinishPacking`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinishPacking->Sortable = TRUE; // Allow sort
		$this->fields['FinishPacking'] = &$this->FinishPacking;
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
			$sortFieldList = ($fld->VirtualExpression <> "") ? $fld->VirtualExpression : $sortField;
			if ($ctrl) {
				$orderByList = $this->getSessionOrderByList();
				if (ContainsString($orderByList, $sortFieldList . " " . $lastSort)) {
					$orderByList = str_replace($sortFieldList . " " . $lastSort, $sortFieldList . " " . $thisSort, $orderByList);
				} else {
					if ($orderByList <> "") $orderByList .= ", ";
					$orderByList .= $sortFieldList . " " . $thisSort;
				}
				$this->setSessionOrderByList($orderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST] = $v;
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "tbl_orderguide") {
			$detailUrl = $GLOBALS["tbl_orderguide"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID_Order=" . urlencode($this->ID_Order->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "tbl_orderdetail") {
			$detailUrl = $GLOBALS["tbl_orderdetail"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID_Order=" . urlencode($this->ID_Order->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "vwhistoryPicking") {
			$detailUrl = $GLOBALS["vwhistoryPicking"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID_Order=" . urlencode($this->ID_Order->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "vwPackingdetail") {
			$detailUrl = $GLOBALS["vwPackingdetail"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID_Order=" . urlencode($this->ID_Order->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "tbl_orderlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`tbl_order`";
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
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT CONCAT(COALESCE(`CodeContact`, ''),'" . ValueSeparator(1, $this->ID_Contact) . "',COALESCE(`ContactName`,'')) FROM `tbl_contact` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`ID_Contact` = `tbl_order`.`ID_Contact` LIMIT 1) AS `EV__ID_Contact` FROM `tbl_order`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList <> "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`ID_Order` DESC";
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
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where <> "")
			$where = " " . str_replace(array("(",")"), array("",""), $where) . " ";
		if ($orderBy <> "")
			$orderBy = " " . str_replace(array("(",")"), array("",""), $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() <> "")
			return TRUE;
		if ($this->ID_Contact->AdvancedSearch->SearchValue <> "" ||
			$this->ID_Contact->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->ID_Contact->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->ID_Contact->VirtualExpression . " "))
			return TRUE;
		return FALSE;
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
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
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
			$this->ID_Order->setDbValue($conn->insert_ID());
			$rs['ID_Order'] = $this->ID_Order->DbValue;
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

		// Cascade Update detail table 'tbl_orderguide'
		$cascadeUpdate = FALSE;
		$rscascade = array();
		if ($rsold && (isset($rs['ID_Order']) && $rsold['ID_Order'] <> $rs['ID_Order'])) { // Update detail field 'ID_Order'
			$cascadeUpdate = TRUE;
			$rscascade['ID_Order'] = $rs['ID_Order']; 
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["tbl_orderguide"]))
				$GLOBALS["tbl_orderguide"] = new tbl_orderguide();
			$rswrk = $GLOBALS["tbl_orderguide"]->loadRs("`ID_Order` = " . QuotedValue($rsold['ID_Order'], DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'ID_Guide';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["tbl_orderguide"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["tbl_orderguide"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["tbl_orderguide"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'tbl_orderdetail'
		$cascadeUpdate = FALSE;
		$rscascade = array();
		if ($rsold && (isset($rs['ID_Order']) && $rsold['ID_Order'] <> $rs['ID_Order'])) { // Update detail field 'ID_Order'
			$cascadeUpdate = TRUE;
			$rscascade['ID_Order'] = $rs['ID_Order']; 
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["tbl_orderdetail"]))
				$GLOBALS["tbl_orderdetail"] = new tbl_orderdetail();
			$rswrk = $GLOBALS["tbl_orderdetail"]->loadRs("`ID_Order` = " . QuotedValue($rsold['ID_Order'], DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'ID_Detail';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["tbl_orderdetail"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["tbl_orderdetail"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["tbl_orderdetail"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'vwPackingdetail'
		$cascadeUpdate = FALSE;
		$rscascade = array();
		if ($rsold && (isset($rs['ID_Order']) && $rsold['ID_Order'] <> $rs['ID_Order'])) { // Update detail field 'Id_order'
			$cascadeUpdate = TRUE;
			$rscascade['Id_order'] = $rs['ID_Order']; 
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["vwPackingdetail"]))
				$GLOBALS["vwPackingdetail"] = new vwPackingdetail();
			$rswrk = $GLOBALS["vwPackingdetail"]->loadRs("`Id_order` = " . QuotedValue($rsold['ID_Order'], DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'Id_packing';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["vwPackingdetail"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["vwPackingdetail"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["vwPackingdetail"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'ID_Order';
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
			if (array_key_exists('ID_Order', $rs))
				AddFilter($where, QuotedName('ID_Order', $this->Dbid) . '=' . QuotedValue($rs['ID_Order'], $this->ID_Order->DataType, $this->Dbid));
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

		// Cascade delete detail table 'tbl_orderguide'
		if (!isset($GLOBALS["tbl_orderguide"]))
			$GLOBALS["tbl_orderguide"] = new tbl_orderguide();
		$rscascade = $GLOBALS["tbl_orderguide"]->loadRs("`ID_Order` = " . QuotedValue($rs['ID_Order'], DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->getRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["tbl_orderguide"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["tbl_orderguide"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["tbl_orderguide"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'tbl_orderdetail'
		if (!isset($GLOBALS["tbl_orderdetail"]))
			$GLOBALS["tbl_orderdetail"] = new tbl_orderdetail();
		$rscascade = $GLOBALS["tbl_orderdetail"]->loadRs("`ID_Order` = " . QuotedValue($rs['ID_Order'], DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->getRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["tbl_orderdetail"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["tbl_orderdetail"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["tbl_orderdetail"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'vwPackingdetail'
		if (!isset($GLOBALS["vwPackingdetail"]))
			$GLOBALS["vwPackingdetail"] = new vwPackingdetail();
		$rscascade = $GLOBALS["vwPackingdetail"]->loadRs("`Id_order` = " . QuotedValue($rs['ID_Order'], DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->getRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["vwPackingdetail"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["vwPackingdetail"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["vwPackingdetail"]->Row_Deleted($dtlrow);
		}
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
		$this->ID_Order->DbValue = $row['ID_Order'];
		$this->OrderDate->DbValue = $row['OrderDate'];
		$this->InvoiceNo->DbValue = $row['InvoiceNo'];
		$this->CusomterOrderNo->DbValue = $row['CusomterOrderNo'];
		$this->IdType->DbValue = $row['IdType'];
		$this->ID_Contact->DbValue = $row['ID_Contact'];
		$this->CreateUser->DbValue = $row['CreateUser'];
		$this->CreateDate->DbValue = $row['CreateDate'];
		$this->StatusLoad->DbValue = $row['StatusLoad'];
		$this->StatusFinishOrder->DbValue = $row['StatusFinishOrder'];
		$this->DateTimefinishOrder->DbValue = $row['DateTimefinishOrder'];
		$this->UserFinishOrder->DbValue = $row['UserFinishOrder'];
		$this->UpdateDate->DbValue = $row['UpdateDate'];
		$this->UpdateUser->DbValue = $row['UpdateUser'];
		$this->PrintSubLable->DbValue = $row['PrintSubLable'];
		$this->Packing->DbValue = $row['Packing'];
		$this->FinishPacking->DbValue = $row['FinishPacking'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID_Order` = @ID_Order@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID_Order', $row) ? $row['ID_Order'] : NULL) : $this->ID_Order->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID_Order@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "tbl_orderlist.php";
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
		if ($pageName == "tbl_orderview.php")
			return $Language->phrase("View");
		elseif ($pageName == "tbl_orderedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "tbl_orderadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "tbl_orderlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_orderview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_orderview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "tbl_orderadd.php?" . $this->getUrlParm($parm);
		else
			$url = "tbl_orderadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("tbl_orderedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_orderedit.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
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
		if ($parm <> "")
			$url = $this->keyUrl("tbl_orderadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("tbl_orderadd.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
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
		return $this->keyUrl("tbl_orderdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID_Order:" . JsonEncode($this->ID_Order->CurrentValue, "number");
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
		if ($this->ID_Order->CurrentValue != NULL) {
			$url .= "ID_Order=" . urlencode($this->ID_Order->CurrentValue);
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
			if (Param("ID_Order") !== NULL)
				$arKeys[] = Param("ID_Order");
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
			$this->ID_Order->CurrentValue = $key;
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
		$this->ID_Order->setDbValue($rs->fields('ID_Order'));
		$this->OrderDate->setDbValue($rs->fields('OrderDate'));
		$this->InvoiceNo->setDbValue($rs->fields('InvoiceNo'));
		$this->CusomterOrderNo->setDbValue($rs->fields('CusomterOrderNo'));
		$this->IdType->setDbValue($rs->fields('IdType'));
		$this->ID_Contact->setDbValue($rs->fields('ID_Contact'));
		$this->CreateUser->setDbValue($rs->fields('CreateUser'));
		$this->CreateDate->setDbValue($rs->fields('CreateDate'));
		$this->StatusLoad->setDbValue($rs->fields('StatusLoad'));
		$this->StatusFinishOrder->setDbValue($rs->fields('StatusFinishOrder'));
		$this->DateTimefinishOrder->setDbValue($rs->fields('DateTimefinishOrder'));
		$this->UserFinishOrder->setDbValue($rs->fields('UserFinishOrder'));
		$this->UpdateDate->setDbValue($rs->fields('UpdateDate'));
		$this->UpdateUser->setDbValue($rs->fields('UpdateUser'));
		$this->PrintSubLable->setDbValue($rs->fields('PrintSubLable'));
		$this->Packing->setDbValue($rs->fields('Packing'));
		$this->FinishPacking->setDbValue($rs->fields('FinishPacking'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID_Order

		$this->ID_Order->CellCssStyle = "white-space: nowrap;";

		// OrderDate
		$this->OrderDate->CellCssStyle = "white-space: nowrap;";

		// InvoiceNo
		$this->InvoiceNo->CellCssStyle = "white-space: nowrap;";

		// CusomterOrderNo
		$this->CusomterOrderNo->CellCssStyle = "white-space: nowrap;";

		// IdType
		$this->IdType->CellCssStyle = "white-space: nowrap;";

		// ID_Contact
		$this->ID_Contact->CellCssStyle = "white-space: nowrap;";

		// CreateUser
		$this->CreateUser->CellCssStyle = "white-space: nowrap;";

		// CreateDate
		$this->CreateDate->CellCssStyle = "white-space: nowrap;";

		// StatusLoad
		$this->StatusLoad->CellCssStyle = "white-space: nowrap;";

		// StatusFinishOrder
		$this->StatusFinishOrder->CellCssStyle = "white-space: nowrap;";

		// DateTimefinishOrder
		$this->DateTimefinishOrder->CellCssStyle = "white-space: nowrap;";

		// UserFinishOrder
		$this->UserFinishOrder->CellCssStyle = "white-space: nowrap;";

		// UpdateDate
		$this->UpdateDate->CellCssStyle = "white-space: nowrap;";

		// UpdateUser
		$this->UpdateUser->CellCssStyle = "white-space: nowrap;";

		// PrintSubLable
		// Packing
		// FinishPacking
		// ID_Order

		$this->ID_Order->ViewValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->CssClass = "font-weight-bold";
		$this->ID_Order->CellCssStyle .= "text-align: center;";
		$this->ID_Order->ViewCustomAttributes = "";

		// OrderDate
		$this->OrderDate->ViewValue = $this->OrderDate->CurrentValue;
		$this->OrderDate->ViewValue = FormatDateTime($this->OrderDate->ViewValue, 7);
		$this->OrderDate->CellCssStyle .= "text-align: center;";
		$this->OrderDate->ViewCustomAttributes = "";

		// InvoiceNo
		$this->InvoiceNo->ViewValue = $this->InvoiceNo->CurrentValue;
		$this->InvoiceNo->ViewCustomAttributes = "";

		// CusomterOrderNo
		$this->CusomterOrderNo->ViewValue = $this->CusomterOrderNo->CurrentValue;
		$this->CusomterOrderNo->ViewCustomAttributes = "";

		// IdType
		$curVal = strval($this->IdType->CurrentValue);
		if ($curVal <> "") {
			$this->IdType->ViewValue = $this->IdType->lookupCacheOption($curVal);
			if ($this->IdType->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`IdType`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->IdType->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->IdType->ViewValue = $this->IdType->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->IdType->ViewValue = $this->IdType->CurrentValue;
				}
			}
		} else {
			$this->IdType->ViewValue = NULL;
		}
		$this->IdType->CssClass = "font-weight-bold";
		$this->IdType->CellCssStyle .= "text-align: center;";
		$this->IdType->ViewCustomAttributes = "";

		// ID_Contact
		if ($this->ID_Contact->VirtualValue <> "") {
			$this->ID_Contact->ViewValue = $this->ID_Contact->VirtualValue;
		} else {
			$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
		$curVal = strval($this->ID_Contact->CurrentValue);
		if ($curVal <> "") {
			$this->ID_Contact->ViewValue = $this->ID_Contact->lookupCacheOption($curVal);
			if ($this->ID_Contact->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ID_Contact`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ID_Contact->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->ID_Contact->ViewValue = $this->ID_Contact->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ID_Contact->ViewValue = $this->ID_Contact->CurrentValue;
				}
			}
		} else {
			$this->ID_Contact->ViewValue = NULL;
		}
		}
		$this->ID_Contact->ViewCustomAttributes = "";

		// CreateUser
		$this->CreateUser->ViewValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->ViewValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->ViewValue = FormatDateTime($this->CreateDate->ViewValue, 11);
		$this->CreateDate->ViewCustomAttributes = "";

		// StatusLoad
		if (strval($this->StatusLoad->CurrentValue) <> "") {
			$this->StatusLoad->ViewValue = $this->StatusLoad->optionCaption($this->StatusLoad->CurrentValue);
		} else {
			$this->StatusLoad->ViewValue = NULL;
		}
		$this->StatusLoad->CellCssStyle .= "text-align: center;";
		$this->StatusLoad->ViewCustomAttributes = "";

		// StatusFinishOrder
		if (strval($this->StatusFinishOrder->CurrentValue) <> "") {
			$this->StatusFinishOrder->ViewValue = $this->StatusFinishOrder->optionCaption($this->StatusFinishOrder->CurrentValue);
		} else {
			$this->StatusFinishOrder->ViewValue = NULL;
		}
		$this->StatusFinishOrder->CellCssStyle .= "text-align: center;";
		$this->StatusFinishOrder->ViewCustomAttributes = "";

		// DateTimefinishOrder
		$this->DateTimefinishOrder->ViewValue = $this->DateTimefinishOrder->CurrentValue;
		$this->DateTimefinishOrder->ViewValue = FormatDateTime($this->DateTimefinishOrder->ViewValue, 0);
		$this->DateTimefinishOrder->ViewCustomAttributes = "";

		// UserFinishOrder
		$this->UserFinishOrder->ViewValue = $this->UserFinishOrder->CurrentValue;
		$this->UserFinishOrder->ViewCustomAttributes = "";

		// UpdateDate
		$this->UpdateDate->ViewValue = $this->UpdateDate->CurrentValue;
		$this->UpdateDate->ViewValue = FormatDateTime($this->UpdateDate->ViewValue, 0);
		$this->UpdateDate->ViewCustomAttributes = "";

		// UpdateUser
		$this->UpdateUser->ViewValue = $this->UpdateUser->CurrentValue;
		$this->UpdateUser->ViewCustomAttributes = "";

		// PrintSubLable
		$this->PrintSubLable->ViewValue = $this->PrintSubLable->CurrentValue;
		$this->PrintSubLable->ViewCustomAttributes = "";

		// Packing
		$this->Packing->ViewValue = $this->Packing->CurrentValue;
		$this->Packing->ViewCustomAttributes = "";

		// FinishPacking
		$this->FinishPacking->ViewValue = $this->FinishPacking->CurrentValue;
		$this->FinishPacking->ViewCustomAttributes = "";

		// ID_Order
		$this->ID_Order->LinkCustomAttributes = "";
		$this->ID_Order->HrefValue = "";
		$this->ID_Order->TooltipValue = "";

		// OrderDate
		$this->OrderDate->LinkCustomAttributes = "";
		$this->OrderDate->HrefValue = "";
		$this->OrderDate->TooltipValue = "";

		// InvoiceNo
		$this->InvoiceNo->LinkCustomAttributes = "";
		$this->InvoiceNo->HrefValue = "";
		$this->InvoiceNo->TooltipValue = "";

		// CusomterOrderNo
		$this->CusomterOrderNo->LinkCustomAttributes = "";
		$this->CusomterOrderNo->HrefValue = "";
		$this->CusomterOrderNo->TooltipValue = "";

		// IdType
		$this->IdType->LinkCustomAttributes = "";
		$this->IdType->HrefValue = "";
		$this->IdType->TooltipValue = "";

		// ID_Contact
		$this->ID_Contact->LinkCustomAttributes = "";
		$this->ID_Contact->HrefValue = "";
		$this->ID_Contact->TooltipValue = "";

		// CreateUser
		$this->CreateUser->LinkCustomAttributes = "";
		$this->CreateUser->HrefValue = "";
		$this->CreateUser->TooltipValue = "";

		// CreateDate
		$this->CreateDate->LinkCustomAttributes = "";
		$this->CreateDate->HrefValue = "";
		$this->CreateDate->TooltipValue = "";

		// StatusLoad
		$this->StatusLoad->LinkCustomAttributes = "";
		$this->StatusLoad->HrefValue = "";
		$this->StatusLoad->TooltipValue = "";

		// StatusFinishOrder
		$this->StatusFinishOrder->LinkCustomAttributes = "";
		$this->StatusFinishOrder->HrefValue = "";
		$this->StatusFinishOrder->TooltipValue = "";

		// DateTimefinishOrder
		$this->DateTimefinishOrder->LinkCustomAttributes = "";
		$this->DateTimefinishOrder->HrefValue = "";
		$this->DateTimefinishOrder->TooltipValue = "";

		// UserFinishOrder
		$this->UserFinishOrder->LinkCustomAttributes = "";
		$this->UserFinishOrder->HrefValue = "";
		$this->UserFinishOrder->TooltipValue = "";

		// UpdateDate
		$this->UpdateDate->LinkCustomAttributes = "";
		$this->UpdateDate->HrefValue = "";
		$this->UpdateDate->TooltipValue = "";

		// UpdateUser
		$this->UpdateUser->LinkCustomAttributes = "";
		$this->UpdateUser->HrefValue = "";
		$this->UpdateUser->TooltipValue = "";

		// PrintSubLable
		$this->PrintSubLable->LinkCustomAttributes = "";
		$this->PrintSubLable->HrefValue = "";
		$this->PrintSubLable->TooltipValue = "";

		// Packing
		$this->Packing->LinkCustomAttributes = "";
		$this->Packing->HrefValue = "";
		$this->Packing->TooltipValue = "";

		// FinishPacking
		$this->FinishPacking->LinkCustomAttributes = "";
		$this->FinishPacking->HrefValue = "";
		$this->FinishPacking->TooltipValue = "";

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

		// ID_Order
		$this->ID_Order->EditAttrs["class"] = "form-control";
		$this->ID_Order->EditCustomAttributes = "";
		$this->ID_Order->EditValue = $this->ID_Order->CurrentValue;
		$this->ID_Order->CssClass = "font-weight-bold";
		$this->ID_Order->CellCssStyle .= "text-align: center;";
		$this->ID_Order->ViewCustomAttributes = "";

		// OrderDate
		$this->OrderDate->EditAttrs["class"] = "form-control";
		$this->OrderDate->EditCustomAttributes = "";
		$this->OrderDate->EditValue = FormatDateTime($this->OrderDate->CurrentValue, 7);
		$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());

		// InvoiceNo
		$this->InvoiceNo->EditAttrs["class"] = "form-control";
		$this->InvoiceNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->InvoiceNo->CurrentValue = HtmlDecode($this->InvoiceNo->CurrentValue);
		$this->InvoiceNo->EditValue = $this->InvoiceNo->CurrentValue;
		$this->InvoiceNo->PlaceHolder = RemoveHtml($this->InvoiceNo->caption());

		// CusomterOrderNo
		$this->CusomterOrderNo->EditAttrs["class"] = "form-control";
		$this->CusomterOrderNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->CusomterOrderNo->CurrentValue = HtmlDecode($this->CusomterOrderNo->CurrentValue);
		$this->CusomterOrderNo->EditValue = $this->CusomterOrderNo->CurrentValue;
		$this->CusomterOrderNo->PlaceHolder = RemoveHtml($this->CusomterOrderNo->caption());

		// IdType
		$this->IdType->EditAttrs["class"] = "form-control";
		$this->IdType->EditCustomAttributes = "";

		// ID_Contact
		$this->ID_Contact->EditAttrs["class"] = "form-control";
		$this->ID_Contact->EditCustomAttributes = "";
		$this->ID_Contact->EditValue = $this->ID_Contact->CurrentValue;
		$this->ID_Contact->PlaceHolder = RemoveHtml($this->ID_Contact->caption());

		// CreateUser
		$this->CreateUser->EditAttrs["class"] = "form-control";
		$this->CreateUser->EditCustomAttributes = "";
		$this->CreateUser->EditValue = $this->CreateUser->CurrentValue;
		$this->CreateUser->ViewCustomAttributes = "";

		// CreateDate
		$this->CreateDate->EditAttrs["class"] = "form-control";
		$this->CreateDate->EditCustomAttributes = "";
		$this->CreateDate->EditValue = $this->CreateDate->CurrentValue;
		$this->CreateDate->EditValue = FormatDateTime($this->CreateDate->EditValue, 11);
		$this->CreateDate->ViewCustomAttributes = "";

		// StatusLoad
		$this->StatusLoad->EditAttrs["class"] = "form-control";
		$this->StatusLoad->EditCustomAttributes = "";
		$this->StatusLoad->EditValue = $this->StatusLoad->options(TRUE);

		// StatusFinishOrder
		$this->StatusFinishOrder->EditAttrs["class"] = "form-control";
		$this->StatusFinishOrder->EditCustomAttributes = "";
		$this->StatusFinishOrder->EditValue = $this->StatusFinishOrder->options(TRUE);

		// DateTimefinishOrder
		$this->DateTimefinishOrder->EditAttrs["class"] = "form-control";
		$this->DateTimefinishOrder->EditCustomAttributes = "";
		$this->DateTimefinishOrder->EditValue = FormatDateTime($this->DateTimefinishOrder->CurrentValue, 8);
		$this->DateTimefinishOrder->PlaceHolder = RemoveHtml($this->DateTimefinishOrder->caption());

		// UserFinishOrder
		$this->UserFinishOrder->EditAttrs["class"] = "form-control";
		$this->UserFinishOrder->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->UserFinishOrder->CurrentValue = HtmlDecode($this->UserFinishOrder->CurrentValue);
		$this->UserFinishOrder->EditValue = $this->UserFinishOrder->CurrentValue;
		$this->UserFinishOrder->PlaceHolder = RemoveHtml($this->UserFinishOrder->caption());

		// UpdateDate
		// UpdateUser
		// PrintSubLable

		$this->PrintSubLable->EditAttrs["class"] = "form-control";
		$this->PrintSubLable->EditCustomAttributes = "";
		$this->PrintSubLable->EditValue = $this->PrintSubLable->CurrentValue;
		$this->PrintSubLable->PlaceHolder = RemoveHtml($this->PrintSubLable->caption());

		// Packing
		$this->Packing->EditAttrs["class"] = "form-control";
		$this->Packing->EditCustomAttributes = "";
		$this->Packing->EditValue = $this->Packing->CurrentValue;
		$this->Packing->PlaceHolder = RemoveHtml($this->Packing->caption());

		// FinishPacking
		$this->FinishPacking->EditAttrs["class"] = "form-control";
		$this->FinishPacking->EditCustomAttributes = "";
		$this->FinishPacking->EditValue = $this->FinishPacking->CurrentValue;
		$this->FinishPacking->PlaceHolder = RemoveHtml($this->FinishPacking->caption());

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
					$doc->exportCaption($this->ID_Order);
					$doc->exportCaption($this->OrderDate);
					$doc->exportCaption($this->InvoiceNo);
					$doc->exportCaption($this->CusomterOrderNo);
					$doc->exportCaption($this->IdType);
					$doc->exportCaption($this->ID_Contact);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->StatusLoad);
				} else {
					$doc->exportCaption($this->ID_Order);
					$doc->exportCaption($this->OrderDate);
					$doc->exportCaption($this->InvoiceNo);
					$doc->exportCaption($this->CusomterOrderNo);
					$doc->exportCaption($this->IdType);
					$doc->exportCaption($this->ID_Contact);
					$doc->exportCaption($this->CreateUser);
					$doc->exportCaption($this->CreateDate);
					$doc->exportCaption($this->StatusLoad);
					$doc->exportCaption($this->StatusFinishOrder);
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
						$doc->exportField($this->ID_Order);
						$doc->exportField($this->OrderDate);
						$doc->exportField($this->InvoiceNo);
						$doc->exportField($this->CusomterOrderNo);
						$doc->exportField($this->IdType);
						$doc->exportField($this->ID_Contact);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->StatusLoad);
					} else {
						$doc->exportField($this->ID_Order);
						$doc->exportField($this->OrderDate);
						$doc->exportField($this->InvoiceNo);
						$doc->exportField($this->CusomterOrderNo);
						$doc->exportField($this->IdType);
						$doc->exportField($this->ID_Contact);
						$doc->exportField($this->CreateUser);
						$doc->exportField($this->CreateDate);
						$doc->exportField($this->StatusLoad);
						$doc->exportField($this->StatusFinishOrder);
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
		$table = 'tbl_order';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'tbl_order';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Order'];

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
		$table = 'tbl_order';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['ID_Order'];

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
		$table = 'tbl_order';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['ID_Order'];

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