# Squadron Admin Site

Welcome to the Admin site for the Australian Air League Moorebank Squadron.
This site has been developed to assist with the Squadron Operations of a meeting night. The main purpose of the site was to track the use of Active and Creative Kids vouchers. To assist with this function a roll was create which allows the squadron staff to check people are present and record how thay paid.

### Table of Contents
-----
 * [Overview](#Overview)
 * [Dashboard](#Dashboard)
 * [Members](#Members-Page)
 * [Member View](#Members-View-Page)
 * [Roll](#Roll)

## Overview
----
### Dashboard
****
When logging into the site, the Dashboard is the site home page. On this page you will see the following information, shown in a number of Cards

#### Members Present
This shows the number of members currently present based on the current Roll Date

#### Members on Roll
This show the number of "League" members currently on the roll

#### Squadron Attandance
This show the % of League members in attendance on the current roll night

#### Active Kids Vouchers
This shows the number of current Active and Creative Kids Vouchers

#### Officers Present
Shows the number of Officers present on the Current Roll Night

#### TO/WO Present
Shows the number of Trainee Officers and Warrent Officers Present on the current Roll night

#### NCO's Present
Shows the number of NCO's Present on the current Roll night

#### Cadets Present
Shows the number of Cadet Present on the current Roll night

#### Subs Collected
Shows the Subs Paid on the current Roll Night (Not including paid outstadning subs)

#### Avg Sqaudron Attendance
Shows the Yearly Avg Squadron Attendance.
The Icon is a trend inducator which with show Up in a Green Box if the value is higher than last Roll week, or show Down in a Red Box if the value is lower than last week.

### Members Page
This will show a list of all current active League Members, this is sorted by Rank
Clicking on the "i" icon will take you to the Member View Page which shows information on that Member.
From this page you can add a new member and search the member list. Some features on this page include:
* Display of Active/Creative Kids Balance.
* Memnbers with "New" Membership number are shown in Red. "New" is the default number unless changed.

### Member View Page
This is accessed from 2 locations - Member List Page or Roll Page. This page contains all the information on the member. So of the features on this page include:
* Active and Creative Kids Balance
* Attendance Rate - Shown as a %, then the rate is above the value set in the settings, the box is green. When below the box is red. Default value for the colour  switch is 80%
* Total Subs Owning - The icon box will be green if no subs owning and red if there is.
* Outstanding Requests - This will show the member has requested an item from Q-Store and the payment for that item is Outstanding. If there is no item Outstanding this box is not shown
* Active Kids Vouchers - This will show all transactions against Active Kids Vouchers. The recording of a voucher and each time an amount is deducted against the voucher - If there is no data to  show, the box is hidden
* Outstanding Subs - This shows the weeks where the member didn't pay Subs. The tick icon marks that week as paid. If nothing to show the box is  hidden.

###### Edit Member
This allows you to edit the members details which are kept within the system

###### Add Voucher
This allows you to add a Active Kids or Creative Kids Voucher. The default amount is $100, however this can be changed

## Roll
The system allows the user to create a roll for each squadron meeting night, this is a very important function of the system as it drives all values which are recorded. The roll view contains the following features:

###### Create New Roll
Allows the user to create a new roll, when creating a roll everyone  is marked as away. As the members are marked present using the buttons (covered below) they are moved to the bottom of the list. The roll is sorted in the following way:
* Members marked as away
    * Rank
    
###### Present - Paid
If a member is present and paid, clicking on the Green Box with the Tick will mark them as such. This follows though and records the value to display as subs collected on that night

###### Present - Voucher
If a member is present and using their voucher balance to pay, ticking on the light blue box with the ticket icon will mark the member as such. This system will also add an entry for the member in the Active kids table shown in the member view and reduce their balance by the sub amount. The system will also check to see if they have a balance to cover the subs, if not a warning message is shown.

###### Present - Not Paid
If a member is present but doesn't pay their subs, click on the Red Box with the cross will mark them as such. This will record them as not paying and add a record to the Outstanding Subs view for that member and increase the total outstanding amount

###### Member View
Clicking on the green box with the "i" icon will show the member page view. This is the same information as the member view. This is handy for adding a Active or Creative kids voucher without leaving the roll

###### First Parade Roll
This will show a list of all members who are present, this is sorted by Rank. The only option is to go back to the roll from this screen


This site has been developped to assist with the Admin operation of the Squadron.
Tasks contained within this site include:
* Member Overview
* Roll
* Active and Creative Kids Vouchers
* Uniform Requests and Payments
* Form 19 overview

