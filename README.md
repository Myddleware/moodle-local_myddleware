# Myddleware and Moodle

## How to connect Myddleware and Moodle : 

Here is the list of available modules in source (reading) and target (writing) :

| Module | Source | Target |
| --- | --- | --- |
| Courses | X | X |
| Users | X | X |
| Group members | X | X |
| Groups | X | X |
| Enrollment | X | X |
| Unenrollment |  | X |
| Notes |  | X |
| Courses completion | X |  |
| Activities completion | X |  |
| Courses last access | X |  |
| Competencies module completion | X |  |
| User competencies | X |  |
| User grades | X |  |

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

![image](https://user-images.githubusercontent.com/95077335/196911939-3d02252a-2a64-4b03-b4de-f96343e09abd.png)

*Congratulations, you‘ve created your Moodle connector ! You can now use it to synchronise data to and from this solution.*

### Running the tests for your plugin
in your root directory, run the following command. Make sure you have installed the phpunit package and initialized it.

vendor/bin/phpunit local/myddleware/tests/provider_test.php --testdox

## Myddleware

### More about Myddleware

Myddleware is the customisable free open-source platform that facilitates data migration and synchonisation between applications.

![myddleware-interface](https://user-images.githubusercontent.com/95077335/196908998-5fafb2e0-5c5e-4771-a398-e9471ea775cb.png)

[On our documentation website](https://myddleware.github.io/myddleware/), you’ll find everything you’re looking for to master Myddleware, including step-by-step tutorials. You can also tailor Myddleware to your needs by creating you custom code. Please use <a href="https://github.com/Myddleware" target="_blank">our github</a> to share it.

This community is ours : let’s all contribute, make it a friendly, helpful space where we can all find what we’re looking for!

Please don’t hide any precious skills from us, whether it is coding, translation, connectors creation, .... the list goes on! The whole community could then benefit from these!

Find us here : [Myddleware](http://www.myddleware.com">www.myddleware.com)

*We created it, you own it!*

![logo](https://user-images.githubusercontent.com/95077335/196912472-29ad70f3-e87e-4218-82b5-16480695b30b.png)
