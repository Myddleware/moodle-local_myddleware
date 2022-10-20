# Myddleware and Moodle

## How to connect Myddleware and Moodle : 

Here is the list of available modules in source (reading) and target (writing) :

| Module | Source | Target |
| --- | --- |
| Courses | :heavy_check-mark: | :heavy_check-mark: |
| Users | :heavy_check-mark: | :heavy_check-mark: |
| Group members |  | :heavy_check-mark: |
| Groups |  | :heavy_check-mark: |
| Enrollment | :heavy_check-mark: | :heavy_check-mark: |
| Unenrollment |  | :heavy_check-mark: |
| Notes |  | :heavy_check-mark: |
| Courses completion | :heavy_check-mark: |  |
| Activities completion | :heavy_check-mark: |  |
| Courses last access | :heavy_check-mark: |  |
| Competencies module completion | :heavy_check-mark: |  |
| User competencies | :heavy_check-mark: |  |
| User grades | :heavy_check-mark: |  |

Need more functionalities ? Please [Contact us](http://www.myddleware.com/contact-us)

Please, install first the [Myddleware Moodle plugin](https://moodle.org/plugins/local_myddleware)

Generate your token by following this tutorial : [here](https://docs.moodle.org/400/en/Using_web_services)

You can use this system role and assigned it to the user linked to your token. Click on this link to download it, then unzip it before importing it in Moodle : [myddleware_moodle_role](http://community.myddleware.com/wp-content/uploads/2016/11/myddleware_moodle_role_1.3-1.zip)

To assigned a role, go to Site administration -> Users -> Assign system roles

![moodle_assigne_role1](http://community.myddleware.com/wp-content/uploads/2016/11/moodle_assigne_role1-1024x408.png)

Choose Myddleware role

![moodle_assigne_role2](http://community.myddleware.com/wp-content/uploads/2016/11/moodle_assigne_role2.png)

Then add the user you want to use in Myddleware :

![moodle_assigne_role3](http://community.myddleware.com/wp-content/uploads/2016/11/moodle_assigne_role3-1024x449.png)

> Myddleware use the protocol REST.

Then open your external service :

![moodle_External_service](http://community.myddleware.com/wp-content/uploads/2016/11/moodle_External_service-768x407.png)

Please add these functions to your external services :

![function_list](http://community.myddleware.com/wp-content/uploads/2016/11/function_list.png)

In the blue box are the standard functions. In the red box are the custom functions used by Myddleware to read data from Moodle. The custom functions have a name beginning by local_myddleware (there is more functions than on the screenshot). 

> Make sure you have installed the Myddleware Moodle plugin if you don’t find these functions in the list. [here](https://moodle.org/plugins/local_myddleware)

### Creation of a connector 

Add the URL of your Moodle instance and your token in Myddleware 


*Congratulations, you‘ve created your Moodle connector ! You can now use it to synchronise data to and from this solution.*

## Myddleware

### More about Myddleware

Myddleware is the customisable free open-source platform that facilitates data migration and synchonisation between applications.

<img class="alignnone size-large wp-image-447" src="http://community.myddleware.com/wp-content/uploads/2016/11/create_rule_view-1024x596.png" alt="create_rule_view" width="640" height="373" />

<a href="http://community.myddleware.com/" target="_blank">On our community website,</a> you�ll find everything you�re looking for to master Myddleware, from step-by-step tutorials, to English and French forums. You can also tailor Myddleware to your needs by creating you custom code. Please use <a href="https://github.com/Myddleware" target="_blank">our github</a> to share it.

This community is ours : let�s all contribute, make it a friendly, helpful space where we can all find what we�re looking for!

Please don�t hide any precious skills from us, whether it is coding, translation, connectors creation, .... the list goes on! The whole community could then benefit from these!

Find us here : <a href="http://www.myddleware.com">www.myddleware.com</a>

*We created it, you own it!*

<img class="alignnone size-medium wp-image-161" src="http://community.myddleware.com/wp-content/uploads/2016/09/myddleware_logo-300x215.jpg" alt="myddleware_logo" width="300" height="215" />