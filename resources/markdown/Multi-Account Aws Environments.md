---
title: Multi-Account Aws Environments
slug: 
author: Carl Cassar
description: AWS recommends that you set up multiple accounts when your environment becomes more complex. This article outlines the benefits of multi-account environments and shows you how to get started.
tags:
  - aws
image: 
link: https://www.carlcassar.com/articles/multi-account-AWS-environments
published_at: 2020-10-05 19:35:00
created_at: 2020-10-05 19:35:00
updated_at: 2020-10-05 19:35:00
deleted_at:
---
I first heard about the full potential of AWS Organisations in
[this excellent talk](https://www.youtube.com/watch?v=aISWoPf_XNE) on IAM Policies. I had seen this option in the
console before, but I thought it would be overkill to create an organisation with multiple accounts when I only had a 
few small projects running on AWS at the time. Nowadays I make a new account for every new project I host on AWS. I love
the organisation and separation of concerns that this brings to my setup. It's given me a lot of confidence to
experiment with new AWS features and configurations.

## What is a multi-account environment?

A multi-account environment is the name that AWS gives to a setup in which you *spread your resources across
multiple accounts*. This might sound like it adds a lot of complexity to your setup, but it's actually very
simple to implement and brings a number of benefits in exchange.

AWS offers an easy way to manage multiple accounts under an AWS organisation in your root account. These new
"sub-accounts" can be grouped into organisational units (OUs), and arranged into a hierarchy that matches your
real-world needs.

[This article on best practices](https://aws.amazon.com/organizations/getting-started/best-practices/)
outlines a number of useful organisational units based on best practices from existing AWS customers.

## When should you set up a multi-account environment?

AWS [recommends](https://aws.amazon.com/organizations/getting-started/best-practices/) this as best practice as
soon as your workload grows in size and complexity.

In my opinion, the benefits are such that you should consider using this technique as soon as possible.

## Benefits of a multi-account AWS environment

1. **Experiment with confidence**

If you're anything like me, you felt pretty overwhelmed the first time you logged into the AWS console. As I'm writing
this, there are now [more than 175](https://en.wikipedia.org/wiki/Amazon_Web_Services) products and services on AWS,
ranging from storage to satellite communications and everything in between. What's more, the learning curve is pretty
steep, and the repercussions of making a mistake can be costly. 

One of the best things you can do when learning to use Amazon Web Services is to set up a sandbox
account in which you can experiment freely, knowing you can tear down your resources when you are done. Of course,
its possible to set up a new root account with the same purpose, but then you wouldn't gain any of the other benefits
of a multi-account environment. 

2. **Simpler, more accurate billing**

As soon as you're working on multiple projects, it becomes useful to know the total cost for the project
across all resources. If you're using a single AWS account you can track the cost of a project by using tags, but
there are several issues with this approach. First, there are some services that don't allow custom tags. Second,
tags have to be managed, updated and maintained, which could lead to some project costs being missed.

By using a separate account for projects, teams or departments, you can track costs accurately across all resources
created in that account. You can then see an overview of all costs across the organisation or drill down into the
charges for each account in the billing dashboard.


3. **Better organisation**

When you use a multi-account environment, you can enforce tag and backup policies for each account. What's 
more, you'll be able to find resources quicker, making it much easier to build solutions that require several
resources to communicate with each other. Multiple accounts will enable you to adapt each account to the specific
needs of your project or team. 

4. **Increased Security**

With each new account, you get a fresh set of IAM users, roles and policies. You can create completely different
security configurations for each account, giving you fine-grained control over access to your resources. This is
especially useful when projects need to meet strict compliance requirements or operate in a different region. 

5. **Scale easier**

You never know when that side project might become your main stay. If you keep all your projects in one account, it can
be extremely tricky and time-consuming to retrospectively extract one of them to another account. If, on the other
hand, you create a new account for your project on day one, you can easily:
- give new users permission to access specific resources
- promote the account to a root account for accounting or other purposes
- hand over the account in the event that you sell the project
- take action quickly and efficiently in case something goes wrong.

## How to set up an AWS organisation

Follow these steps to create your AWS organisation:

1. Click on your name on the AWS Management Console.
2. Choose "My Organisation"
3. Choose "Create Organisation"
4. Choose "Enable all features or Enable only consolidated billing."
5. Choose "Create"

[See this article](https://aws.amazon.com/premiumsupport/knowledge-center/get-started-organizations/) to watch a short
video on how to set up your AWS organisation.

## How to add a new account to your organisation

Once you've created your organisation, you're ready to add another account. You can either create a new account or
invite an existing account to join your organisation.

Follow these steps to add a new account to your organisation:

1. Click on your name on the AWS Management Console.
2. Choose "My Organisation"
3. Chose "Add account"
4. Choose "Create account"
5. Fill in the "Account Name", "Email Address" and "IAM role name".
6. Add any tags that you want to add to the account.
7. Choose "Create"

The **IAM role name** specifies the name of a role that will be created by AWS in the new account and allow you to
gain access to it. The default value is `OrganizationAccountAccessRole`, which will grant the organisation full
administrative control over the new account.

## Conclusion

This setup may not be for everyone, but it can be a powerful option in your AWS toolbox when you outgrow your root
account. Personally, I wish I had known about this option sooner and haven't regretted the decision to use this 
architecture for my own projects.
