<x-app-layout title="Privacy Policy">
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Privacy Policy') }}
        </h1>
    </x-slot>

    <div class="prose">
        <p>This privacy policy discloses the privacy practices for
            <x-link :href="route('home')">carlcassar.com</x-link>
            .

            This privacy policy applies solely to
            information collected by this website. It will notify you of the following:

        <ul class="list-disc">
            <li>
                <x-link href="#account-registration">
                    Account Registration
                </x-link>
                -
                Information about data collected upon registration.
            </li>
            <li>
                <x-link href="#information-collection-use-and-sharing">
                    Information Collection, Use, and Sharing
                </x-link>
                -
                What personally identifiable information is collected from you through the website, how it is used
                and with whom it may be shared.
            </li>
            <li>
                <x-link href="#analytics">
                    Analytics
                </x-link>
                -
                Information about our anonymous collection of usage analytics.
            </li>
            <li>
                <x-link href="#your-access-to-and-control-over-information">
                    Your Access to and Control Over Information
                </x-link>
                -
                What choices are available to you regarding the use of your data. How you can correct any inaccuracies
                in the information.
            </li>
            <li>
                <x-link href="#account-deletion">
                    Account Deletion
                </x-link>
                -
                Your rights to removing any information we are not required to keep by law.
            </li>
            <li>
                <x-link href="#security">
                    Security
                </x-link>
                -
                The security procedures in place to protect the misuse of your information.
            </li>
            <li>
                <x-link href="#external-links">
                    External Links
                </x-link>
                -
                Information about the limits of this privacy policy in relation to external links.
            </li>
            <li>
                <x-link href="#updates">
                    Updates
                </x-link>
                -
                A notice regarding the way in which this information might be updated in the future.
            </li>
        </ul>

        <h2 id="account-registration">Registration</h2>
        <p>
            <strong>No information is collected about you before registration.</strong>
        </p>

        <p>
            Registration is not required in order to use this website, but it does offer a number of conveniences. In
            order to offer these services, a user must first complete the registration form. During registration a user
            is required to give certain information (such as name and email address). This information is used to
            contact you about the products/services on our site in which you have expressed interest.
        </p>

        <p>
            Cookies are small text files that are placed on your computer by websites that you visit. They are widely
            used in order to make websites work, or work more efficiently, as well as to provide information to the
            owners of the site. Cookies will only be used on this site to keep track of your session information.
            Cookies are not used for analytics.
        </p>

        <h2 id="information-collection-use-and-sharing">Information Collection, Use, and Sharing</h2>

        <p>
            We are the sole owners of the information collected on this site. We only have access to/collect information
            that you voluntarily give us via email or other direct contact from you.
        </p>
        <p>
            <strong>We will not sell or rent this information to anyone.</strong> We will use your information to
            respond to you, regarding the reason you contacted us. We will not share your information with any third
            party outside our organization, other than as necessary to fulfill your request, e.g. to ship an order.
            Unless you ask us not to, we may contact you via
            email in the future to tell you about new articles, specials, new products or services, or changes to this
            privacy policy. You can opt out of all notifications at any time.
        </p>

        <h2 id="analytics">Analytics</h2>
        <p>
            This site uses a privacy-focused cookie-free analytics platform called
            <x-link href="https://usefathom.com/ref/QR9NX6">Fathom</x-link>
            .
            Fathom <strong>doesn't use any cookies</strong> and doesn't collect <strong>any personal
                information</strong>.
            Fathom allows us to collect information about how this site is used without
            gathering <strong>any</strong> information about individual users.
            <x-link href="https://usefathom.com/ref/QR9NX6/privacy-focused-web-analytics">Read this article about
                privacy-focused analytics
            </x-link>
            if you want to know more.
        </p>


        <h2 id="your-access-to-and-control-over-information">Your Access to and Control Over Information</h2>
        <p>
            Once you are registered, you may opt out of any future contacts from us at any time. You can do the
            following at any time by
            contacting us via email at
            <x-link href="mailto:support@carlcssar.com">support@carlcassar.com</x-link>
            :
        </p>
        <ul>
            <li>See what data we have about you if any.</li>
            <li>Change/correct any data we have about you.</li>
            <li>Have us delete any data we have about you.</li>
            <li>Express any concern you have about our use of your data.</li>
        </ul>

        <p>Remember that you also manage your own data in your account settings.</p>

        <h2 id="account-deletion">Account Deletion</h2>
        <p>
            Once registered, you have the option to delete your account easily at any time. If you choose this option,
            we will only retain the information - if any - that we are legally obliged to keep for accounting and other
            purposes.
        </p>

        <h2 id="security">Security</h2>
        <p>
            We take precautions to protect your information. When you submit sensitive information via the website, your
            information is protected both online and offline.
        </p>
        <p>
            Wherever we collect sensitive information (such as credit
            card data), that information is encrypted and transmitted to us in a secure way. You can verify this by
            looking for a closed lock icon at the bottom of your web browser, or looking for "https" at the beginning of
            the address of the web page.
        </p>
        <p>
            While we use encryption to protect sensitive information transmitted online, we
            also protect your information offline. Only employees who need the information to perform a specific job
            (for example, billing or customer service) are granted access to personally identifiable information. The
            computers/servers in which we store personally identifiable information are kept in a secure
            environment.
        </p>

        <h2 id="external-links">Links</h2>
        <p>
            This website contains links to other sites. Please be aware that we are not responsible for the content or
            privacy practices of such other sites. We encourage our users to be aware when they leave our site and to
            read the privacy statements of any other site that collects personally identifiable information.
        </p>

        <h2 id="updates">Updates</h2>
        Our Privacy Policy may change from time to time and all updates will be posted on this page.
        If you feel that we are not abiding by this privacy policy, you should contact us immediately via email at
        <x-link href="mailto:support@carlcssar.com">support@carlcassar.com</x-link>
        .
        <p class="font-bold">Last Modified: 6th September, 2023</p>
    </div>
</x-app-layout>
