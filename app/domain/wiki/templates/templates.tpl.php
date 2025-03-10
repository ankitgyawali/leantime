<?php


use leantime\core\eventhelpers;

$today = date($this->__('language.dateformat'));
$author = $_SESSION['userdata']['name'].' ('.$_SESSION['userdata']['mail'].')';

    //Templates for tinymce templates
    //All Templates require title, description, content

    $templates = array();

    $prdTpl = new \leantime\domain\models\wiki\template();

    $prdTpl->title = $this->__("templates.prd.title");
    $prdTpl->description = $this->__("templates.prd.description");
    $prdTpl->category = $this->__("templates.documents");
    $prdTpl->content = '
<h1><strong>'.$this->__("templates.prd.title_for_prd").'<br /></strong></h1>
<p>'.$this->__("templates.author").' '.$author.'<br />
'.$this->__("templates.dates").' '.$today.'<br />
'.$this->__("templates.status").' <label class="label-default">'.$this->__("templates.status.draft").'</label><br />

<table style="border-collapse: collapse; width: 100%;" border="1">
<thead>
<tr>
<td style="width: 23.3025%;">'.$this->__("templates.prd.responsible").'</td>
<td style="width: 23.3025%;">'.$this->__("templates.prd.approve").'</td>
<td style="width: 23.3025%;">'.$this->__("templates.prd.consulted").'</td>
<td style="width: 23.3025%;">'.$this->__("templates.prd.informed").'</td>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 23.3025%;">&nbsp;</td>
<td style="width: 23.3025%;">&nbsp;</td>
<td style="width: 23.3025%;">&nbsp;</td>
<td style="width: 23.3025%;">&nbsp;</td>
</tr>
</tbody>
</table>
<h1>'.$this->__("templates.summary").'</h1>
<h2>'.$this->__("templates.overview").'</h2>
<p>'.$this->__("templates.prd.overview_description").'</p>

<h2>'.$this->__("templates.problem").'</h2>
<p>'.$this->__("templates.prd.problem_description").'</p>

<h2 >Goals (What are we working towards?</h2>
<p>1. Goal</p>
<p>2. Goal</p>
<p>3. Goal</p>
<h2>Risks (Things that could get in the way or stop progress)</h2>
<p>1. Risk</p>
<p>2. Risk</p>
<p>3. Risk</p>
<h2>Who is the Customer &amp; Description</h2>
<p>Who are the target personas for this product, and which is the key persona?</p>
<table style="border-collapse: collapse; width: 50%;" border="1">
<tbody>
<tr style="height: 17px;">
<td style="width: 11.8519%; height: 17px;">Customer</td>
<td style="width: 88.1481%; height: 17px;">Description (interests, likes, demographics, where to find them)</td>
</tr>
<tr style="height: 17px;">
<td style="width: 11.8519%; height: 17px;">Customer</td>
<td style="width: 88.1481%; height: 17px;">Description (interests, likes, demographics, where to find them)</td>
</tr>
<tr>
<td style="width: 11.8519%;">Customer</td>
<td style="width: 88.1481%;">Description (interests, likes, demographics, where to find them)</td>
</tr>
</tbody>
</table>
<h2 >How will the customer use the product?</h2>
<p>Instances where various personas will use the product, in context.</p>
<h3>Use case</h3>
<p>Describe the use case</p>
<h3>Use case</h3>
<p>Describe the use case</p>
<h3>Use case</h3>
<p>Describe the use case</p>
<h1>Product Details</h1>
<p>When you&rsquo;ve locked in your One Pager, build out your PRD. Use the finalized One Pager and the following.</p>
<h2>Features - Must haves</h2>
<p>These are the distinct, prioritized features along with a short explanation of why this feature is important. Briefly outline the scope, the goals, and use case.</p>
<ul>
<li>Feature</li>
<li>Feature</li>
<li>Feature</li>
</ul>
<h2>Features - Nice to Haves</h2>
<ul>
<li>Feature</li>
<li>Feature</li>
<li>Feature</li>
</ul>
<h2>Features - Absolutely Not</h2>
<p>What features have you explicitly decided not to do and why?</p>
<ul>
<li>Feature</li>
<li>Feature</li>
<li>Feature</li>
</ul>
<h2>Design - Any files, images, wireframes or details go here (link to idea board)</h2>
<p>Include any needed early sketches, and throughout the project, link to the actual designs once they&rsquo;re available.</p>
<h2>echnical Considerations - (optional)</h2>
<p>Link to engineering technical approach document.</p>
<h2>Success Metrics</h2>
<p class="c8">What are the&nbsp;<a class="c35" href="https://www.google.com/url?q=https://productschool.com/blog/data-analytics/metrics-product-managers-measure/&amp;sa=D&amp;source=editors&amp;ust=1680296200488974&amp;usg=AOvVaw0DDV-fM6FNiXcUAQjmi42e">success metrics</a>that indicate you&rsquo;re achieving your internal goals for the project? How will you measure success?&nbsp;You can use any goal-setting and tracking system you prefer (OKRs, KPIs, etc).</p>
<p>Note:</span><span class="c58">&nbsp;Link to Analytics requirements and approach document.</span></p>
<h2>GTM Approach</h2>
<p>What&rsquo;s the product messaging that your &nbsp;marketing department will use to describe this product to existing and new customers? How do you plan to launch this product to the market with marketing and sales teams?</p>
<p>Note:</span><span class="c20 c63 c56 c58">&nbsp;Link to a larger GTM brief if available.</p>
<h2>Open Issues</h2>
<p>What factors do you still need to figure out? What problems may arise and how do you plan on addressing them?</p>
<h2>Q&amp;A</h2>
<p>What are common questions about the product along with the answers you&rsquo;ve decided? This is a good place to note key decisions.</p>
<table style="border-collapse: collapse; width: 100.041%;" border="1">
<thead>
<tr>
<td style="width: 23.3025%;">Question</td>
<td style="width: 23.3025%;">Answer</td>
<td style="width: 23.3025%;">Asked By</td>
<td style="width: 23.3025%;">Answered By</td>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 23.3025%;">&nbsp;</td>
<td style="width: 23.3025%;">&nbsp;</td>
<td style="width: 23.3025%;">&nbsp;</td>
<td style="width: 23.3025%;">&nbsp;</td>
</tr>
</tbody>
</table>
<h2>PRD Checklist</span></h2>
<p class="c8">Here&rsquo;s a list of topics you must include in your PRD:</p>
<ul class="tox-checklist" style="list-style-type: none;">
<li>Title</li>
<li>Author</li>
<li>Decision Log</li>
<li>Change History</li>
<li>Overview</li>
<li>Messaging</li>
<li>Personas</li>
<li>User Scenarios</li>
<li>User Stories/Features/Requirements</li>
<li>Design</li>
<li>Open Issues</li>
<li>Q&amp;A</li>
</ul>
';
$templates[] = $prdTpl;

//Project Outline
$projectOutline = new \leantime\domain\models\wiki\template();
$projectOutline->title = "Project Outline";
$projectOutline->category = $this->__("templates.documents");
$projectOutline->description = "";
$projectOutline->content = '
<h1><strong>Project Outline<br /></strong></h1>
<p>Author: '.$author.'<br />
Date: '.$today.'<br />
Status: <label class="label-default">Draft</label><br />
<table style="border-collapse: collapse; width: 100.146%; background-color: #ffffff; height: 182px;" border="1">
<tbody>
<tr style="height: 17px;">
<td style="width: 17.3786%; height: 17px; background-color: #3598db;"><strong><span style="color: #ffffff;">Why we\'re doing this:</span></strong></td>
<td style="height: 17px; width: 82.6214%;" colspan="3">&lt; insert project justification &gt;</td>
</tr>
<tr style="height: 17px;">
<td style="width: 17.3786%; height: 17px; background-color: #3598db;"><strong><span style="color: #ffffff;">What are we working on:</span></strong></td>
<td style="height: 17px; width: 82.6214%;" colspan="3">&lt; insert project description &gt;</td>
</tr>
<tr style="height: 46px;">
<td style="width: 17.3786%; height: 46px; background-color: #3598db;">
<p><strong><span style="color: #ffffff;">Project Objectives:</span></strong></p>
</td>
<td style="height: 46px; width: 82.6214%;" colspan="3">
<ul>
<li>Objective 1</li>
<li>Objective 2</li>
<li>Objective 3</li>
</ul>
</td>
</tr>
<tr style="height: 17px;">
<td style="width: 17.3786%; height: 17px; background-color: #3598db;"><strong><span style="color: #ffffff;">High Level Requirements:</span></strong></td>
<td style="height: 17px; width: 82.6214%;" colspan="3">
<ul>
<li>Requirement 1</li>
<li>Requirement 2</li>
<li>Requirement 3</li>
</ul>
</td>
</tr>
<tr style="height: 17px;">
<td style="width: 17.3786%; height: 17px; background-color: #3598db;"><strong><span style="color: #ffffff;">In Scope Work</span></strong></td>
<td style="height: 17px; width: 82.6214%;" colspan="3">
<ul>
<li>Item</li>
<li>Item</li>
<li>Item</li>
</ul>
</td>
</tr>
<tr style="height: 17px;">
<td style="width: 17.3786%; height: 17px; background-color: #3598db;"><strong><span style="color: #ffffff;">No-go\'s / Out of Scope:</span></strong></td>
<td style="height: 17px; width: 82.6214%;" colspan="3">
<ul>
<li>Item</li>
<li>Item</li>
<li>Item</li>
</ul>
</td>
</tr>
<tr style="height: 17px;">
<td style="width: 17.3786%; height: 17px; background-color: #3598db;"><strong><span style="color: #ffffff;">Cost Estimates:</span></strong></td>
<td style="height: 17px; width: 82.6214%;" colspan="3">
<table style="border-collapse: collapse; width: 99.9991%; height: 68.875px;" border="1">
<thead>
<tr style="height: 51.875px;" data-mce-active="1">
<td style="width: 17.5448%; height: 51.875px;">
<h5>Cost Item</h5>
</td>
<td style="width: 17.5448%; height: 51.875px;">
<h5>Estimated Project Cost</h5>
</td>
<td style="width: 17.5448%; height: 51.875px;">
<h5>Actual Spend</h5>
</td>
<td style="width: 17.5448%; height: 51.875px;">
<h5>Cost Until Completion</h5>
</td>
<td style="width: 17.5475%; height: 51.875px;" data-mce-active="1">
<h5>Variance</h5>
</td>
</tr>
</thead>
<tbody>
<tr style="height: 17px;">
<td style="width: 17.5448%; height: 17px;">&lt; Software &gt;</td>
<td style="width: 17.5448%; height: 17px;">&lt; $1500 &gt;</td>
<td style="width: 17.5448%; height: 17px;">&lt; $700 &gt;</td>
<td style="width: 17.5448%; height: 17px;">&nbsp;</td>
<td style="width: 17.5475%; height: 17px;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';
$templates[] = $projectOutline;


//User Story
$userStoryTpl = new \leantime\domain\models\wiki\template();
$userStoryTpl->title = "User Story";
$userStoryTpl->category = $this->__("templates.todos");
$userStoryTpl->description = "A template for an agile user story";
$userStoryTpl->content = '
<table style="border-collapse: collapse; width: 100.049%;" border="1">
<thead>
<tr>
<td style="width: 33.3333%;">Title:</td>
<td style="width: 33.3333%;">Priority:</td>
<td style="width: 33.3333%;">Estimate:</td>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 100%;" colspan="3">
<h4><strong>User Story</strong></h4>
<p><strong>As a</strong> &lt;insert type of user&gt;</p>
<p><strong>I want to&nbsp;</strong>&lt;perform some task&gt;<br /><br /><strong>so that I can</strong> &lt;achieve some goal&gt;</p>
</td>
</tr>
<tr >
<td colspan="3" >
<p><strong>Acceptance Criteria:</strong></p>
<p><strong>Given&nbsp;</strong>&lt;some context&gt;<br /><br /><strong>When&nbsp; </strong>&lt;some action is carried out&gt;</p>
<p><strong>Then&nbsp;</strong>&lt;a set of observable outcomes should occur&gt;&nbsp;</p>
</td>
</tr>
</tbody>
</table>';
$templates[] = $userStoryTpl;


$bugTpl = new \leantime\domain\models\wiki\template();
$bugTpl->title = "Bug";
$bugTpl->category = $this->__("templates.todos");
$bugTpl->description = "A template for a bug report";
$bugTpl->content = '<table style="border-collapse: collapse; width: 100.051%;" border="1">
 <tbody>
 <tr data-mce-active="1">
 <td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Summary</strong></span></td>
 <td style="width: 82.7562%;" data-mce-active="1">summarize the issue your are experiencing</td>
 </tr>
 <tr>
 <td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Environment</strong></span></td>
 <td style="width: 82.7562%;">describe the environment under which the problem occured (hosted, production, staging etc)</td>
 </tr>
 <tr>
 <td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Reproduction Steps</strong></span></td>
 <td style="width: 82.7562%;">Describe the steps to reproduce the problem<br />
 <ol>
 <li>Step 1</li>
 <li>Step 2</li>
 </ol>
 </td>
 </tr>
 <tr>
 <td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Expected Outcome</strong></span></td>
 <td style="width: 82.7562%;">describe what you expected would happen</td>
 </tr>
 <tr>
 <td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Actual Outcome</strong></span></td>
 <td style="width: 82.7562%;">describe what actually happened</td>
 </tr>
 <tr>
 <td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Impact</strong></span></td>
 <td style="width: 82.7562%;">describe how impactful this issue is to your workflow (eg can not work at all; delays my work; large inconvenience etc)</td>
 </tr>
 <tr>
 <td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Additional Details</strong></span></td>
 <td style="width: 82.7562%;">Anything else you would like to mention</td>
 </tr>
 </tbody>
 </table>';

$templates[] = $bugTpl;


$featureTpl = new \leantime\domain\models\wiki\template();
$featureTpl->title = "Feature Request";
$featureTpl->category = $this->__("templates.todos");
$featureTpl->description = "A template for a feature request";
$featureTpl->content = '<table style="border-collapse: collapse; width: 100.051%;" border="1">
<tbody>
<tr>
<td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Summary</strong></span></td>
<td style="width: 82.7562%;">summarize the feature you would like</td>
</tr>
<tr>
<td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Target User</strong></span></td>
<td style="width: 82.7562%;">describe who benefits most from this feature</td>
</tr>
<tr>
<td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Desired Timeline</strong></span></td>
<td style="width: 82.7562%;">when would you like to see it implemented</td>
</tr>
<tr>
<td style="width: 17.2438%; background-color: #1b75bb;"><span style="color: #ffffff;"><strong>Additional Details</strong></span></td>
<td style="width: 82.7562%;">any additional details</td>
</tr>
</tbody>
</table>';

$templates[] = $featureTpl;


$layout48 = new \leantime\domain\models\wiki\template();
$layout48->title = $this->__("templates.side_left");
$layout48->category = $this->__("templates.layouts");
$layout48->description = $this->__("templates.titles.side_left_description");

$layout48->content = '
<div class="row">
<div class="col-md-4"><p>Sidebar Left</p></div>
<div class="col-md-8"><p>Content Right</p></div>
</div>';
$templates[] =$layout48;

$layout84 = new \leantime\domain\models\wiki\template();
$layout84->title = $this->__("templates.side_right");
$layout84->category = $this->__("templates.layouts");
$layout84->description = $this->__("templates.titles.side_right_description");
$layout84->content = '
<div class="row">
<div class="col-md-8"><p>Content Left</p></div>
<div class="col-md-4"><p>Sidebar Right</p></div>
</div>';
$templates[] =$layout84;

$layout363 = new \leantime\domain\models\wiki\template();
$layout363->title = $this->__("templates.side_m_side");
$layout363->category = $this->__("templates.layouts");
$layout363->description = $this->__("templates.titles.side_m_side_description");
$layout363->content = '
<div class="row">
<div class="col-md-3"><p>Sidebar Left</p></div>
<div class="col-md-6"><p>Content Center</p> </div>
<div class="col-md-3"><p>Sidebar Right</p></div>
</div>';
$templates[] = $layout363;


$layout66 = new \leantime\domain\models\wiki\template();
$layout66->title = $this->__("templates.titles.2_col");
$layout66->category = $this->__("templates.layouts");
$layout66->description = $this->__("templates.titles.2_col_description");
$layout66->content = '
<div class="row">
<div class="col-md-6"><p>Column 1</div>
<div class="col-md-6"><p>Column 2</div>
</div>';
$templates[] =$layout66;

$layout444 = new \leantime\domain\models\wiki\template();
$layout444->title = $this->__("templates.titles.3_col");
$layout444->category = $this->__("templates.layouts");
$layout444->description = $this->__("templates.titles.3_col_description");
$layout444->content = '
<div class="row">
<div class="col-md-4"><p>Column 1</p></div>
<div class="col-md-4"><p>Column 2</p></div>
<div class="col-md-4"><p>Column 3</p></div>
</div>';
$templates[] = $layout444;

$layout3333 = new \leantime\domain\models\wiki\template();
$layout3333->title = $this->__("templates.titles.4_col");
$layout3333->category = $this->__("templates.layouts");
$layout3333->description = $this->__("templates.titles.4_col_description");
$layout3333->content = '
<div class="row">
<div class="col-md-3"><p>Column 1</p></div>
<div class="col-md-3"><p>Column 2</p></div>
<div class="col-md-3"><p>Column 3</p></div>
<div class="col-md-3"><p>Column 4</p></div>
</div>';
$templates[] = $layout3333;

$labelGreen = new \leantime\domain\models\wiki\template();
$labelGreen->title = $this->__("templates.titles.green_status");
$labelGreen->category = $this->__("templates.elements");
$labelGreen->description = $this->__("templates.titles.green_status_description");
$labelGreen->content = '<label class="label-success">Green</label>';
$templates[] = $labelGreen;

$labelYellow = new \leantime\domain\models\wiki\template();
$labelYellow->title = $this->__("templates.titles.yellow_status");
$labelYellow->category = $this->__("templates.elements");
$labelYellow->description = $this->__("templates.titles.yellow_status_description");
$labelYellow->content = '<label class="label-warning">Yellow</label>';
$templates[] = $labelYellow;

$labelRed = new \leantime\domain\models\wiki\template();
$labelRed->title = $this->__("templates.titles.red_status");
$labelRed->category = $this->__("templates.elements");
$labelRed->description = $this->__("templates.titles.red_status_description");
$labelRed->content = '<label class="label-danger">Red</label>';
$templates[] = $labelRed;

$labelGray = new \leantime\domain\models\wiki\template();
$labelGray->title = $this->__("templates.titles.gray_status");
$labelGray->category = $this->__("templates.elements");
$labelGray->description = $this->__("templates.titles.gray_status_description");
$labelGray->content = '<label class="label-default">Gray</label>';
$templates[] = $labelGray;


$templates = eventhelpers::dispatch_filter("documentTemplates", $templates);

echo json_encode($templates);



