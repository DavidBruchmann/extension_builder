.. include:: /Includes.rst.txt

.. _generated-extension:

===================
Generated extension
===================

The generated extension looks like this, following the blog example from the
previous chapter:

.. code-block:: none

   .
   └── ebt_blog/
       ├── composer.json
       ├── ext_emconf.php
       ├── ext_localconf.php
       ├── ext_tables.php
       ├── ext_tables.sql
       ├── ExtensionBuilder.json
       ├── Classes/
           ├── Controller/..
           └── Domain/
               ├── Model/..
               └── Repository/..
       ├── Configuration/
           ├── ExtensionBuilder/..
           ├── TCA/..
           └── TypoScript/..
       ├── Documentation/..
       ├── Resources/
           ├── Private/
               ├── Language/..
               ├── Layouts/..
               ├── Partials/..
               └── Templates/..
           └── Public/
               └── Icons/..
       └── Tests/
           ├── Functional/..
           └── Unit/..

.. _basic-extension-files:

Basic extension files
=====================

The minimum set of extension files generated when only the required metadata
has been entered into the property form and no domain modeling has been
performed:

.. code-block:: none

   .
   └── ebt_blog/
       ├── composer.json
       ├── ext_emconf.php
       ├── ExtensionBuilder.json
       ├── Configuration/
           └── ExtensionBuilder/..
       ├── Documentation/..
       └── Resources/
           └── Public/
               └── Icons/
                   └── Extension.svg

The extension metadata is stored in the :file:`composer.json` and :file:`ext_emconf.php`
files and is used for installations in Composer mode and Legacy mode
respectively.
The extension icon :file:`Extension.svg` is displayed in the list of extensions of the
Extension Manager module.
The :file:`Documentation/` folder contains a basic set of documentation files.
Read the section ":ref:`documentation`" how to proceed with the documentation.

The Extension Builder stores some internal data in the :file:`ExtensionBuilder.json`
file and in the :file:`Configuration/ExtensionBuilder/` folder which should be
kept as long as the extension is edited in the Extension Builder.

.. _domain-modeling-files:

Domain modeling files
=====================

Most of the extension files are created for modeling the domain and configuring
frontend plugins and backend modules:

.. code-block:: none

   .
   └── ebt_blog/
       ├── ext_localconf.php
       ├── ext_tables.php
       ├── ext_tables.sql
       ├── Classes/
           ├── Controller/..
           └── Domain/
               ├── Model/..
               └── Repository/..
       ├── Configuration/
           ├── TCA/..
           └── TypoScript/..
       ├── Resources/
           ├── Private/
               ├── Language/..
               ├── Layouts/..
               ├── Partials/..
               └── Templates/..
           └── Public/
               └── Icons/..
       └── Tests/
           ├── Functional/..
           └── Unit/..

The frontend plugins are registered in the :file:`ext_localconf.php` file and
the backend modules are registered in the :file:`ext_tables.php` file.
The associated views are configured in the :file:`Configuration/TypoScript/`
folder and the Fluid view templates are bundled in the :file:`Resources/Private/`
folder.

The database schema of the domain model is defined in the :file:`ext_tables.sql`
file.
The Extbase classes that define the domain model are provided in the
:file:`Classes/` folder, their presentation in the TYPO3 backend is configured
in the :file:`Configuration/TCA/` folder.
Last but not least, the tests of the PHP classes are located in the folder
:file:`Tests/`.

For more information on tests, see the section ":ref:`tests`" and for everything
else, please refer to the :doc:`Extbase & Fluid book <t3extbasebook:Index>` of
the official TYPO3 documentation.

.. _documentation:

Documentation
=============

The Extension Builder has already created sample documentation for your
extension if you have :guilabel:`Generate documentation template` enabled in
the property form.

.. _writing-documentation:

Writing documentation
---------------------

Now rename the sample folder :file:`Documentation.tmpl/` to :file:`Documentation/`.

The generated documentation is written in the *reStructuredText* (reST)
markup language with support for *Sphinx directives* and provides a typical
documentation structure with some dummy entries. More about how to document with
reStructuredText and Sphinx can be found in the official TYPO3 documentation:

* :ref:`introduction to reST & Sphinx <h2document:writing-rest-introduction>`
* :ref:`h2document:rest-cheat-sheet`
* :ref:`h2document:format-rest-cgl`
* :ref:`h2document:rest-common-pitfalls`

.. _render-documentation:

Render documentation
--------------------

Once you have made changes to the documentation files, you should render them
locally to test the output. The recommended method is to use the official
TYPO3 Documentation Team Docker image, but you can also install all the required
rendering tools from scratch. You can find more about this in the official TYPO3
documentation on the page ":doc:`h2document:RenderingDocs/Index`".

.. _publish-documentation:

Publish documentation
---------------------

If you publish the extension to the *TYPO3 Extension Repository* (TER), do not
put the rendered documentation under version control, as the documentation will
be registered during the :doc:`publishing process </PublishToTer/Index>` for
automatic rendering and deployment to
:samp:`https://docs.typo3.org/typo3cms/extensions/<extension_name>/`.

If the extension is for private use, you are free to do anything with the
rendered documentation - including, of course, putting it under version control.

.. _tests:

Tests
=====

The TYPO3 Core is covered by thousands of tests of varying complexity:
Unit tests (testing part of a class), functional tests (testing multiple classes
in combination) and acceptance tests (testing the entire website user
experience). To simplify testing, the general functionality for writing tests is
bundled in the `TYPO3 Testing Framework <https://github.com/TYPO3/testing-framework>`__,
and all custom tests should use it by inheriting from its base classes.

The Extension Builder generates a set of unit tests and a dummy functional test
that easily cover the generated classes of your extension. The generated tests
should encourage you to write your own tests once you start customizing the
code.

If you are new to testing, we recommend that you invest
some time to learn the benefits of software testing. It will certainly improve
the quality of your software, but it will also boost your programming skills.
Moreover, it will allow you to refactor without fear of breaking anything:
Code that is covered by tests shows less unexpected behavior after refactoring.

.. _covered-classes-and-methods:

Covered classes and methods
---------------------------

The Extension Builder generates unit tests for the public API of

1. domain models and
2. default controller actions.

.. _covered-domain-model-methods:

Covered domain model methods
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The covered domain model methods match the patterns

*  get*()
*  set*()
*  add*()
*  remove*().

For example:

.. code-block:: php

   /**
    * @test
    */
   public function setNameForStringSetsName() {
       $this->subject->setName('Conceived at T3CON10');

       self::assertAttributeEquals(
           'Conceived at T3CON10',
           'name',
           $this->subject
       );
   }

All types of properties are covered, for example integers, strings, file
references or relations to other domain models.

.. _covered-controller-actions:

Covered controller actions
~~~~~~~~~~~~~~~~~~~~~~~~~~

The covered controller actions match the names

*  listAction()
*  showAction()
*  newAction()
*  createAction()
*  editAction()
*  updateAction()
*  deleteAction()

and test the following behavior:

*  asserting data in the action is assigned to the view
*  asserting the action delegates data modifications to a repository,
   like adding, updating, removing or fetching objects

For example:

.. code-block:: php

   /**
    * @test
    */
   public function deleteActionRemovesTheGivenBlogFromBlogRepository() {
       $blog = new \Vendor\Example\Domain\Model\Blog();

       $blogRepository = $this->getMock(
           \Vendor\Example\Domain\Repository\BlogRepository::class,
           ['remove'],
           [],
           '',
           false
       );
       $blogRepository->expects(self::once())->method('remove')->with($blog);
       $this->inject($this->subject, 'blogRepository', $blogRepository);

       $this->subject->deleteAction($blog);
   }

.. _running-tests:

Running tests
-------------

Unit tests of your extension can be executed in the TYPO3 backend using the
`phpunit <https://extensions.typo3.org/extension/phpunit>`__ extension or on the
command line by following the :doc:`testing pages <t3coreapi:Testing/Index>`
of the official TYPO3 documentation.