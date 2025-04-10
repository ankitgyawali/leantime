<?php

    defined('RESTRICTED') or die('Restricted access');
    $tickets        = $this->get("tickets");
    $sprints        = $this->get("sprints");
    $searchCriteria = $this->get("searchCriteria");
    $currentSprint  = $this->get("currentSprint");

    $todoTypeIcons  = $this->get("ticketTypeIcons");

    $efforts        = $this->get('efforts');
    $priorities     = $this->get('priorities');



    //Count Columns to show
    $numberofColumns = count($this->get('allKanbanColumns'));

if ($numberofColumns > 0) {
    $size = floor(100 / $numberofColumns);
} else {
    $size = 100;
}

?>

 <div class="pageheader">

    <div class="pageicon"><span class="fa fa-fw fa-thumb-tack"></span></div>
    <div class="pagetitle">
        <h5><?php $this->e($_SESSION['currentProjectClient'] . " // " . $_SESSION['currentProjectName'] ?? ''); ?></h5>
        <h1><?=$this->__("headlines.todos"); ?></h1>
    </div>

</div><!--pageheader-->

<div class="maincontent">

    <div class="maincontentinner">
        <?php
            echo $this->displayNotification();
        ?>

        <form action="" method="get" id="ticketSearch">

            <input type="hidden" value="true" name="search"/>
            <input type="hidden" value="<?php echo $_SESSION['currentProject']; ?>" name="projectId" id="projectIdInput"/>
            <div class="row">
                <div class="col-md-4">
                    <?php if ($login::userIsAtLeast($roles::$editor)) { ?>
                        <div class="btn-group">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?=$this->__("links.new_with_icon") ?> <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="<?=BASE_URL ?>/tickets/newTicket" class='ticketModal'> <?=$this->__("links.add_todo") ?></a></li>
                                <li><a href="<?=BASE_URL ?>/tickets/editMilestone" class="milestoneModal"><?=$this->__("links.add_milestone") ?></a></li>
                                <li><a href="<?=BASE_URL ?>/sprints/editSprint" class="sprintModal"><?=$this->__("links.add_sprint") ?></a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-4 center">
                    <span class="currentSprint">
                        <?php  if ($this->get('sprints') !== false && count($this->get('sprints'))  > 0) {?>
                        <select data-placeholder="<?=$this->__("input.placeholders.filter_by_sprint") ?>" title="<?=$this->__("input.placeholders.filter_by_sprint") ?>" name="sprint" class="mainSprintSelector" onchange="form.submit()" id="sprintSelect">
                            <option value="all" <?php if ($searchCriteria['sprint'] != "all") {
                                echo"selected='selected'";
                                                } ?>><?=$this->__("links.all_todos") ?></option>
                            <option value="backlog" <?php if ($searchCriteria['sprint'] == "backlog") {
                                echo"selected='selected'";
                                                    } ?>><?=$this->__("links.backlog") ?></option>
                            <?php
                            $dates = "";
                            foreach ($this->get('sprints') as $sprintRow) {   ?>
                                <?php echo"<option value='" . $sprintRow->id . "'";

                                if ($this->get("currentSprint") !== false && $sprintRow->id == $this->get("currentSprint")) {
                                    echo " selected='selected' ";

                                    $dates = sprintf($this->__("label.date_from_date_to"), $this->getFormattedDateString($sprintRow->startDate), $this->getFormattedDateString($sprintRow->endDate));
                                }
                                echo ">";
                                $this->e($sprintRow->name);
                                echo "</option>";
                                ?>

                            <?php }     ?>
                            </select>
                            <br/>
                            <?php if ($login::userIsAtLeast($roles::$editor)) { ?>
                                <small>
                                    <?php if ($dates != "") {
                                        echo $dates; ?> - <a href="<?=BASE_URL ?>/sprints/editSprint/<?=$this->get("currentSprint")?>" class="sprintModal"><?=$this->__("links.edit_sprint") ?></a>
                                    <?php } else { ?>
                                        <a href="<?=BASE_URL ?>/sprints/editSprint" class="sprintModal"><?=$this->__("links.create_sprint") ?></a>
                                    <?php } ?>
                                </small>
                            <?php } ?>
                        <?php } ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <a onclick="leantime.ticketsController.toggleFilterBar();" class="btn btn-default" data-tippy-content="<?=$this->__("popover.filter") ?>"><i class="fas fa-filter"></i><?=$this->get('numOfFilters') > 0 ? " (".$this->get('numOfFilters').")" : "" ?></a>
                        <div class="btn-group viewDropDown">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" data-tippy-content="<?=$this->__("popover.view") ?>"><i class=" fas fa-columns"></i></button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php if (isset($_SESSION['lastFilterdTicketKanbanView']) && $_SESSION['lastFilterdTicketKanbanView'] != "") {
                                    echo $_SESSION['lastFilterdTicketKanbanView'];
                                             } else {
                                                 echo BASE_URL . "/tickets/showKanban";
                                             } ?>" class="active"><?=$this->__("links.kanban") ?></a></li>
                                <li><a href="<?php if (isset($_SESSION['lastFilterdTicketTableView']) && $_SESSION['lastFilterdTicketTableView'] != "") {
                                    echo $_SESSION['lastFilterdTicketTableView'];
                                             } else {
                                                 echo BASE_URL . "/tickets/showAll";
                                             } ?>" ><?=$this->__("links.table") ?></a></li>
                                <li><a href="<?php if (isset($_SESSION['lastFilterdTicketListView']) && $_SESSION['lastFilterdTicketListView'] != "") {
                                        echo $_SESSION['lastFilterdTicketListView'];
                                    } else {
                                        echo BASE_URL . "/tickets/showList";
                                    } ?>" ><?=$this->__("links.list_view") ?></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="filterBar hideOnLoad">
                <div class="row-fluid" style="opacity:0.4">

                    <div class="filterBoxLeft">
                        <label class="inline"><?=$this->__("label.user") ?></label>
                        <div class="form-group">
                            <select data-placeholder="<?=$this->__("input.placeholders.filter_by_user") ?>" title="<?=$this->__("input.placeholders.filter_by_user") ?>" name="users" multiple="multiple" class="user-select" id="userSelect">
                                <option value=""></option>
                                <?php
                                foreach ($this->get('users') as $userRow) {   ?>
                                    <?php echo"<option value='" . $userRow["id"] . "'";

                                    if ($searchCriteria['users'] !== false && $searchCriteria['users'] !== null && array_search($userRow["id"], explode(",", $searchCriteria['users'])) !== false) {
                                        echo" selected='selected' ";
                                    }

                                    echo">" . sprintf($this->__("text.full_name"), $this->escape($userRow["firstname"]), $this->escape($userRow['lastname'])) . "</option>"; ?>

                                <?php } ?>
                            </select>
                        </div>


                    </div>
                    <div class="filterBoxLeft">

                        <label class="inline"><?=$this->__("label.milestone") ?></label>
                        <div class="form-group">
                            <select data-placeholder="<?=$this->__("input.placeholders.filter_by_milestone") ?>" title="<?=$this->__("input.placeholders.filter_by_milestone") ?>" name="milestone"  id="milestoneSelect">
                                <option value=""><?=$this->__("label.all_milestones") ?></option>
                                <?php foreach ($this->get('milestones') as $milestoneRow) {   ?>
                                    <?php echo"<option value='" . $milestoneRow->id . "'";

                                    if (isset($searchCriteria['milestone']) && ($searchCriteria['milestone'] == $milestoneRow->id)) {
                                        echo" selected='selected' ";
                                    }

                                    echo">" . $this->escape($milestoneRow->headline) . "</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>

                    </div>

                    <div class="filterBoxLeft">

                        <label class="inline"><?=$this->__("label.todo_type") ?></label>
                        <div class="form-group">
                            <select data-placeholder="<?=$this->__("input.placeholders.filter_by_milestone") ?>" title="<?=$this->__("input.placeholders.filter_by_milestone") ?>" name="type" id="typeSelect">
                                <option value=""><?=$this->__("label.all_types") ?></option>
                                <?php foreach ($this->get('types') as $type) {    ?>
                                    <?php echo"<option value='" . $type . "'";

                                    if (isset($searchCriteria['type']) && ($searchCriteria['type'] == $type)) {
                                        echo" selected='selected' ";
                                    }

                                    echo">$type</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>

                    </div>

                    <div class="filterBoxLeft">

                        <label class="inline"><?=$this->__("label.todo_priority") ?></label>
                        <div class="form-group">
                            <select data-placeholder="<?=$this->__("input.placeholders.filter_by_priority") ?>" title="<?=$this->__("input.placeholders.filter_by_priority") ?>" name="type" id="prioritySelect">
                                <option value=""><?=$this->__("label.all_priorities") ?></option>
                                <?php foreach ($this->get('priorities') as $priorityKey => $priorityValue) {    ?>
                                    <?php echo"<option value='" . $priorityKey . "'";

                                    if (isset($searchCriteria['priority']) && ($searchCriteria['priority'] == $priorityKey)) {
                                        echo" selected='selected' ";
                                    }

                                    echo">$priorityValue</option>"; ?>

                                <?php }     ?>
                            </select>
                        </div>
                    </div>

                    <div class="filterBoxLeft">
                        <label class="inline"><?=$this->__("label.search_term") ?></label><br />
                        <input type="text" class="form-control input-default" id="termInput" name="term" placeholder="Search" value="<?php $this->e($searchCriteria['term']); ?>">
                        <input type="submit" value="Search" name="submitSearch" class="form-control btn btn-primary pull-left" id="filterFormSubmit"/>
                    </div>

                </div>
            </div>
        </form>

        <div id="sortableTicketKanban" class="sortableTicketList kanbanBoard">

            <div class="row-fluid">

                <?php

                foreach ($this->get('allKanbanColumns') as $key => $statusRow) {
                    ?>

                        <div class="column" style="width:<?=$size?>%;">

                            <h4 class="widgettitle title-primary title-border-<?php echo $statusRow['class']; ?>">
                            <?php if ($login::userIsAtLeast($roles::$manager)) { ?>
                                <div class="inlineDropDownContainer" style="float:right;">
                                    <a href="javascript:void(0);" class="dropdown-toggle ticketDropDown editHeadline" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a href="<?=BASE_URL ?>/setting/editBoxLabel?module=ticketlabels&label=<?=$key?>" class="editLabelModal"><?=$this->__('headlines.edit_label')?></a>
                                        </li>
                                        <li><a href="<?=BASE_URL ?>/projects/showProject/<?=$_SESSION['currentProject'];?>#todosettings"><?=$this->__('links.add_remove_col')?></a></li>
                                    </ul>
                                </div>
                            <?php } ?>
                                <strong class="count">0</strong>
                            <?php $this->e($statusRow['name']); ?></h4>


                            <div class="contentInner <?php echo"status_" . $key;?>" >
                                <div>
                                    <a href="javascript:void(0);" class="quickAddLink" id="ticket_new_link_<?=$key?>" onclick="jQuery('#ticket_new_<?=$key?>').toggle('fast', function() {jQuery(this).find('input[name=headline]').focus();}); jQuery(this).toggle('fast');"><i class="fas fa-plus-circle"></i> <?php echo $this->__("links.add_todo_no_icon"); ?></a>
                                    <div class="ticketBox hideOnLoad " id="ticket_new_<?=$key?>">

                                        <form method="post">
                                            <input type="text" name="headline" style="width:100%;" title="<?=$this->__("label.headline") ?>"/><br />
                                            <input type="hidden" name="milestone" value="<?php echo $searchCriteria['milestone']; ?>" />
                                            <input type="hidden" name="status" value="<?php echo $key; ?> " />
                                            <input type="hidden" name="sprint" value="<?php echo $_SESSION["currentSprint"]; ?> " />
                                            <input type="submit" value="Save" name="quickadd" />
                                            <a href="javascript:void(0);" onclick="jQuery('#ticket_new_<?=$key?>').toggle('fast'); jQuery('#ticket_new_link_<?=$key?>').toggle('fast');">
                                                <?=$this->__("links.cancel") ?>
                                            </a>
                                        </form>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <?php foreach ($this->get('allTickets') as $row) { ?>
                                    <?php if ($row["status"] == $key) {?>
                                    <div class="ticketBox moveable container priority-border-<?=$row['priority']?>" id="ticket_<?php echo$row["id"];?>">

                                        <div class="row">

                                            <div class="col-md-12">


                                                <?php if ($login::userIsAtLeast($roles::$editor)) {
                                                    $clockedIn = $this->get("onTheClock");

                                                    ?>
                                                    <div class="inlineDropDownContainer" style="float:right;">

                                                        <a href="javascript:void(0);" class="dropdown-toggle ticketDropDown" data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li class="nav-header"><?php echo $this->__("subtitles.todo"); ?></li>
                                                            <li><a href="<?=BASE_URL ?>/tickets/showTicket/<?php echo $row["id"]; ?>" class='ticketModal'><i class="fa fa-edit"></i> <?php echo $this->__("links.edit_todo"); ?></a></li>
                                                            <li><a href="<?=BASE_URL ?>/tickets/moveTicket/<?php echo $row["id"]; ?>" class="moveTicketModal sprintModal"><i class="fa-solid fa-arrow-right-arrow-left"></i> <?php echo $this->__("links.move_todo"); ?></a></li>
                                                            <li><a href="<?=BASE_URL ?>/tickets/delTicket/<?php echo $row["id"]; ?>" class="delete"><i class="fa fa-trash"></i> <?php echo $this->__("links.delete_todo"); ?></a></li>
                                                            <li class="nav-header border"><?php echo $this->__("subtitles.track_time"); ?></li>
                                                            <li id="timerContainer-<?php echo $row['id'];?>" class="timerContainer">
                                                                <a class="punchIn" href="javascript:void(0);" data-value="<?php echo $row["id"]; ?>" <?php if ($clockedIn !== false) {
                                                                    echo"style='display:none;'";
                                                                                                                          }?>><span class="fa-regular fa-clock"></span> <?php echo $this->__("links.start_work"); ?></a>
                                                                <a class="punchOut" href="javascript:void(0);" data-value="<?php echo $row["id"]; ?>" <?php if ($clockedIn === false || $clockedIn["id"] != $row["id"]) {
                                                                    echo"style='display:none;'";
                                                                                                                           }?>><span class="fa fa-stop"></span> <?php if (is_array($clockedIn) == true) {
                                                                                                                           echo sprintf($this->__("links.stop_work_started_at"), date($this->__("language.timeformat"), $clockedIn["since"]));
                                                                                                                           } else {
                                                                                                                               echo sprintf($this->__("links.stop_work_started_at"), date($this->__("language.timeformat"), time()));
                                                                                                                           }?></a>
                                                                <span class='working' <?php if ($clockedIn === false || $clockedIn["id"] === $row["id"]) {
                                                                    echo"style='display:none;'";
                                                                                      }?>><?php echo $this->__("text.timer_set_other_todo"); ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php } ?>
                                                <?php if($row['dependingTicketId'] > 0){ ?>
                                                    <small><a href="<?=BASE_URL?>/tickets/showKanban/#/tickets/showTicket/<?=$row['dependingTicketId'] ?>" class="form-modal"><?=$this->escape($row['parentHeadline']) ?></a></small> //
                                                <?php } ?>
                                                <small><i class="fa <?php echo $todoTypeIcons[strtolower($row['type'])]; ?>"></i> <?php echo $this->__("label." . strtolower($row['type'])); ?></small>
                                                <small>#<?php echo $row['id']; ?></small>
                                                <div class="kanbanCardContent">
                                                    <h4><a href="<?=BASE_URL?>/tickets/showKanban/#/tickets/showTicket/<?php echo $row["id"];?>"><?php $this->e($row["headline"]);?></a></h4>

                                                    <div class="kanbanContent" style="margin-bottom: 20px">
                                                        <?php echo $this->escapeMinimal($row['description']); ?>
                                                    </div>


                                                </div>
                                                <?php if ($row['dateToFinish'] != "0000-00-00 00:00:00" && $row['dateToFinish'] != "1969-12-31 00:00:00") {
                                                    $date = new DateTime($row['dateToFinish']);
                                                    $date = $date->format($this->__("language.dateformat"));
                                                    echo $this->__("label.due_icon"); ?>
                                                    <input type="text" title="<?php echo $this->__("label.due"); ?>" value="<?php echo $date ?>" class="duedates secretInput" style="margin-left:0px;" data-id="<?php echo $row['id'];?>" name="date" />

                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="clearfix" style="padding-bottom: 8px;"></div>

                                        <div class="timerContainer " id="timerContainer-<?php echo $row["id"]; ?>" >

                                                <div class="dropdown ticketDropdown milestoneDropdown colorized show firstDropdown" >
                                                    <a style="background-color:<?=$this->escape($row['milestoneColor'])?>" class="dropdown-toggle f-left  label-default milestone" href="javascript:void(0);" role="button" id="milestoneDropdownMenuLink<?=$row['id']?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text"><?php
                                                        if ($row['milestoneid'] != "" && $row['milestoneid'] != 0) {
                                                            $this->e($row['milestoneHeadline']);
                                                        } else {
                                                            echo $this->__("label.no_milestone");
                                                        }?>
                                                        </span>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="milestoneDropdownMenuLink<?=$row['id']?>">
                                                        <li class="nav-header border"><?=$this->__("dropdown.choose_milestone")?></li>
                                                        <li class='dropdown-item'><a style='background-color:#b0b0b0' href='javascript:void(0);' data-label="<?=$this->__("label.no_milestone")?>" data-value='<?=$row['id'] . "_0_#b0b0b0"?>'> <?=$this->__("label.no_milestone")?> </a></li>

                                                        <?php foreach ($this->get('milestones') as $milestone) {
                                                            echo"<li class='dropdown-item'>
                                                                <a href='javascript:void(0);' data-label='" . $this->escape($milestone->headline) . "' data-value='" . $row['id'] . "_" . $milestone->id . "_" . $this->escape($milestone->tags) . "' id='ticketMilestoneChange" . $row['id'] . $milestone->id . "' style='background-color:" . $this->escape($milestone->tags) . "'>" . $this->escape($milestone->headline) . "</a>";
                                                            echo"</li>";
                                                        }?>
                                                    </ul>
                                                </div>


                                            <?php if ($row['storypoints'] != '' && $row['storypoints'] > 0) { ?>
                                                <div class="dropdown ticketDropdown effortDropdown show">
                                                <a class="dropdown-toggle f-left  label-default effort" href="javascript:void(0);" role="button" id="effortDropdownMenuLink<?=$row['id']?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text"><?php
                                                    if ($row['storypoints'] != '' && $row['storypoints'] > 0) {
                                                        echo $efforts[$row['storypoints']];
                                                    } else {
                                                        echo $this->__("label.story_points_unkown");
                                                    }?>
                                                    </span>
                                                    &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="effortDropdownMenuLink<?=$row['id']?>">
                                                    <li class="nav-header border"><?=$this->__("dropdown.how_big_todo")?></li>
                                                    <?php foreach ($efforts as $effortKey => $effortValue) {
                                                        echo"<li class='dropdown-item'>
                                                                            <a href='javascript:void(0);' data-value='" . $row['id'] . "_" . $effortKey . "' id='ticketEffortChange" . $row['id'] . $effortKey . "'>" . $effortValue . "</a>";
                                                        echo"</li>";
                                                    }?>
                                                </ul>
                                            </div>
                                            <?php } ?>


                                                <div class="dropdown ticketDropdown priorityDropdown show">
                                                <a class="dropdown-toggle f-left  label-default priority priority-bg-<?=$row['priority']?>" href="javascript:void(0);" role="button" id="priorityDropdownMenuLink<?=$row['id']?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text"><?php
                                                    if ($row['priority'] != '' && $row['priority'] > 0) {
                                                        echo $priorities[$row['priority']];
                                                    } else {
                                                        echo $this->__("label.priority_unkown");
                                                    }?>
                                                    </span>
                                                    &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="priorityDropdownMenuLink<?=$row['id']?>">
                                                    <li class="nav-header border"><?=$this->__("dropdown.select_priority")?></li>
                                                    <?php foreach ($priorities as $priorityKey => $priorityValue) {
                                                        echo"<li class='dropdown-item'>
                                                                            <a href='javascript:void(0);' class='priority-bg-" . $priorityKey . "' data-value='" . $row['id'] . "_" . $priorityKey . "' id='ticketPriorityChange" . $row['id'] . $priorityKey . "'>" . $priorityValue . "</a>";
                                                        echo"</li>";
                                                    }?>
                                                </ul>
                                            </div>


                                            <div class="dropdown ticketDropdown userDropdown noBg show right lastDropdown dropRight">
                                                <a class="dropdown-toggle f-left" href="javascript:void(0);" role="button" id="userDropdownMenuLink<?=$row['id']?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text">
                                                        <?php
                                                        if ($row["editorFirstname"] != "") {
                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=" . $row['editorId'] . "' width='25' style='vertical-align: middle;'/></span>";
                                                        } else {
                                                            echo "<span id='userImage" . $row['id'] . "'><img src='" . BASE_URL . "/api/users?profileImage=false' width='25' style='vertical-align: middle;'/></span>";
                                                        }?>
                                                    </span>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="userDropdownMenuLink<?=$row['id']?>">
                                                    <li class="nav-header border"><?=$this->__("dropdown.choose_user")?></li>

                                                    <?php
                                                    if (is_array($this->get('users'))) {
                                                        foreach ($this->get('users') as $user) {
                                                            echo "<li class='dropdown-item'>
                                                                <a href='javascript:void(0);' data-label='" . sprintf(
                                                                $this->__("text.full_name"),
                                                                $this->escape($user["firstname"]),
                                                                $this->escape($user['lastname'])
                                                            ) . "' data-value='" . $row['id'] . "_" . $user['id'] . "_" . $user['profileId'] . "' id='userStatusChange" . $row['id'] . $user['id'] . "' ><img src='" . BASE_URL . "/api/users?profileImage=" . $user['id'] . "' width='25' style='vertical-align: middle; margin-right:5px;'/>" . sprintf(
                                                                $this->__("text.full_name"),
                                                                $this->escape($user["firstname"]),
                                                                $this->escape($user['lastname'])
                                                            ) . "</a>";
                                                            echo "</li>";
                                                        }
                                                    }?>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>

                                        <?php if ($row["commentCount"] > 0 || $row["subtaskCount"] > 0 || $row['tags'] != '') {?>
                                        <div class="row">

                                            <div class="col-md-12 border-top" style="white-space: nowrap;">
                                                <?php if ($row["commentCount"] > 0) {?>
                                                    <a href="<?=CURRENT_URL ?>?tab=comments#/tickets/showTicket/<?php echo $row["id"];?>" class="ticketModal"><span class="fa-regular fa-comments"></span> <?php echo $row["commentCount"] ?></a>&nbsp;
                                                <?php } ?>

                                                <?php if ($row["subtaskCount"] > 0) {?>
                                                    <a id="subtaskLink_<?php echo $row["id"];?>" href="<?=CURRENT_URL ?>?tab=subtasks#/tickets/showTicket/<?php echo $row["id"];?>" class="subtaskLineLink"> <span class="fa fa-diagram-successor"></span> <?php echo $row["subtaskCount"] ?></a>&nbsp;
                                                <?php } ?>
                                                <?php if ($row['tags'] != '') {?>
                                                    <?php  $tagsArray = explode(",", $row['tags']); ?>
                                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-tags" aria-hidden="true"></i> <?=count($tagsArray)?>
                                                    </a>
                                                    <ul class="dropdown-menu ">
                                                        <li style="padding:10px"><div class='tagsinput readonly'>
                                                        <?php

                                                        foreach ($tagsArray as $tag) {
                                                            echo"<span class='tag'><span>" . $tag . "</span></span>";
                                                        }

                                                        ?>
                                                            </div></li></ul>
                                                <?php } ?>

                                                <?php
                                                    /*<a href="<?=BASE_URL ?>/tickets/showTicket/<?php echo $row["id"];?>#files"><span class="fa-paper-clip"></span> <?php echo $row["fileCount"] ?></a>&nbsp;&nbsp;&nbsp;*/
                                                ?>



                                            </div>


                                        </div>
                                        <?php } ?>



                                    </div>
                                    <?php } ?>
                                <?php } ?>

                            </div>

                        </div>
                <?php } ?>

            </div>
            <div class="clearfix"></div>

        </div>
    </div>

</div>

<script type="text/javascript">

    leantime.ticketsController.initTicketSearchSubmit("<?=BASE_URL?>/tickets/showKanban");
    leantime.ticketsController.initUserSelectBox();
    leantime.ticketsController.initStatusSelectBox();

    <?php if ($login::userIsAtLeast($roles::$editor)) { ?>
        leantime.ticketsController.initUserDropdown();
        leantime.ticketsController.initMilestoneDropdown();
        leantime.ticketsController.initEffortDropdown();
        leantime.ticketsController.initPriorityDropdown();

        var ticketStatusList = [<?php foreach ($this->get('allTicketStates') as $key => $statusRow) {
            echo "'" . $key . "',";
                                }?>];
        leantime.ticketsController.initTicketKanban(ticketStatusList);

    <?php } else { ?>
        leantime.generalController.makeInputReadonly(".maincontentinner");
    <?php } ?>

    leantime.ticketsController.setUpKanbanColumns();

    jQuery(document).ready(function(){

        leantime.ticketsController.initModals();

        <?php if (isset($_GET['showTicketModal'])) {
            if ($_GET['showTicketModal'] == "") {
                $modalUrl = "";
            } else {
                $modalUrl = "/" . (int)$_GET['showTicketModal'];
            }
            ?>

        leantime.ticketsController.openTicketModalManually("<?=BASE_URL ?>/tickets/showTicket<?php echo $modalUrl; ?>");
        window.history.pushState({},document.title, '<?=BASE_URL ?>/tickets/showKanban');

        <?php } ?>


        <?php foreach($this->get('allTickets') as $ticket) {
            if($ticket['dependingTicketId'] > 0){
            ?>
            var startElement = jQuery('#subtaskLink_<?=$ticket['dependingTicketId']; ?>')[0];
            var endElement =  document.getElementById('ticket_<?=$ticket['id']; ?>');

            if ( startElement != null && endElement != undefined) {


                var startAnchor = LeaderLine.mouseHoverAnchor({
                    element: startElement,
                    showEffectName: 'draw',
                    style: {background: 'none', backgroundColor: 'none'},
                    hoverStyle: {background: 'none', backgroundColor: 'none', cursor: 'pointer'}
                });

                var line<?=$ticket['id'] ?> = new LeaderLine(startAnchor, endElement, {
                    startPlugColor: 'var(--accent1)',
                    endPlugColor: 'var(--accent2)',
                    gradient: true,
                    size: 2,
                    path: "grid",
                    startSocket: 'bottom',
                    endSocket: 'auto'
                });

                jQuery("#ticket_<?=$ticket['id'] ?>").mousedown(function () {
                    isDragging = false;
                })
                    .mousemove(function () {
                        isDragging = true;
                        line<?=$ticket['id'] ?>.position();
                    })
                    .mouseup(function () {
                        line<?=$ticket['id'] ?>.position();
                    });

                jQuery("#ticket_<?=$ticket['dependingTicketId'] ?>").mousedown(function () {

                })
                    .mousemove(function () {

                        line<?=$ticket['id'] ?>.position();
                    })
                    .mouseup(function () {
                        line<?=$ticket['id'] ?>.position();

                    });

            }

        <?php }
        } ?>




    });
</script>
