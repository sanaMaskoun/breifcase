<?php

namespace Database\Seeders;

use App\Enums\FAQLangEnum;
use App\Models\FAQ;
use Illuminate\Database\Seeder;

class f_a_q_sSeeder extends Seeder
{

    public function run(): void
    {
        FAQ::create(
            [
                'question' => 'What is Briefcase?',
                'answer' => ' Briefcase is a platform that connects legal practitioners with  clients and other legal professionals. Our mission is to streamline legal practice by providing advanced tools and resources to enhance your reach and efficiency.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How do I register on Briefcase?',
                'answer' => '  Registration is simple and free. Just click on the "Sign Up"  button on our homepage, fill in your details, and follow the  instructions to complete your registration.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'Is there a cost to use Briefcase?',
                'answer' => ' No, registering and using the basic features of Briefcase is  completely free. We offer premium features at a competitive price for those who want to take their practice to the next  level.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How can Briefcase help my legal practice?',
                'answer' => ' Briefcase helps you manage your practice more efficiently by  providing tools for case management, client communication, and  networking. It also increases your visibility to potential clients and allows you to collaborate with other legal  professionals',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'Can I access Briefcase from my mobile device?',
                'answer' => 'Yes, Briefcase is accessible from any device with an internet connection, including smartphones and tablets. This allows you  to manage your practice on the go.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'How secure is my information on Briefcase?',
                'answer' => 'We take security very seriously. All your data is encrypted and  stored securely. We comply with the highest standards of data protection and privacy to ensure your information is safe.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How do I contact support if I have a problem?',
                'answer' => 'You can reach our support team by emailing us at  Info@BriefcasePlatform.com. We are here to assist you with any  issues or questions you may have',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'Can I network with other legal professionals on Briefcase?',
                'answer' => ' Yes, as a lawyer, Briefcase offers a networking feature that  allows you to connect with legal professionals. You can share  knowledge, seek advice, and collaborate on cases.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'What makes Briefcase different from other legal platforms?',
                'answer' => 'Briefcase stands out due to its free registration and comprehensive suite of tools designed specifically for legal   practitioners. Our focus on connecting legal professionals and  providing high-quality resources sets us apart. We are currently  operating in the UAE, with plans to expand globally in the near  future.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How secure is my information on Briefcase?',
                'answer' => 'We take security very seriously. All your data is encrypted and  stored securely. We comply with the highest standards of data  protection and privacy to ensure your information is safe',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How do I contact support if I have a problem?',
                'answer' => 'You can reach our support team by emailing us at Info@BriefcasePlatform.com. We are here to assist you with any  issues or questions you may have',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'Can I customize my profile on Briefcase?',
                'answer' => 'Yes, you can customize your profile to showcase your expertise, experience, and specializations. This helps potential clients  understand your skills and qualifications better.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'How do I manage my cases on Briefcase?',
                'answer' => 'Briefcase offers a comprehensive case management system where    you can create, update, and track your cases. You can organize  documents, set reminders for deadlines, and communicate with  clients and colleagues within the platform',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How do I ensure my profile stands out to potential clients?',
                'answer' => 'To make your profile stand out, ensure it is complete and   up-to-date, including detailed descriptions of your expertise  and experience. Adding client testimonials and case studies can  also enhance your profile’s attractiveness.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => ' What is the process for handling client payments through  Briefcase?',
                'answer' => 'Briefcase offers secure payment processing features that allow  clients to pay for your services directly through the platform. You can manage invoices, track payments, and ensure timely  transactions within your account settings.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'How does Briefcase help with client acquisition?',
                'answer' => 'Briefcase increases your visibility to potential clients through  its search and matching algorithms. By maintaining an updated and detailed profile, you improve your chances of being matched  with clients seeking your specific expertise.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'What security measures are in place to protect my data?',
                'answer' => 'Briefcase employs advanced security measures, including   encryption, secure data storage, and regular security audits to  protect your sensitive information. We comply with international  data protection standards to ensure your data is safe.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'How can I provide feedback or suggest improvements for  Briefcase?',
                'answer' => ' We welcome feedback and suggestions from our users. You can provide feedback directly through the platform’s feedback form or by contacting our support team. We continuously strive to  improve our services based on user input',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How do I find a legal practitioner on Briefcase?',
                'answer' => 'You can search for legal practitioners using various filters such as area of law, location, and experience. Our advanced  search functionality helps you find the best match for your  legal needs.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'Is there a cost to use Briefcase to find a lawyer?',
                'answer' => 'No, using Briefcase to search for and connect with legal   practitioners is free for clients. You may only need to pay for the legal services you choose to engage.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'How can I be sure that the legal practitioners on Briefcase are qualified?',
                'answer' => 'All legal practitioners on Briefcase go through a verification   process to ensure they are qualified and in good standing. We   review their credentials, experience, and client reviews to    maintain a high standard of service.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'Can I read reviews and ratings of legal practitioners?',
                'answer' => 'Yes, Briefcase allows clients to read reviews and ratings from   other clients. This helps you make an informed decision when   choosing a legal practitioner.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How do I contact a legal practitioner on Briefcase?',
                'answer' => 'Once you find a legal practitioner that fits your needs, you can     contact them directly through the platform using our secure  messaging system.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How does Briefcase save me time and effort?',
                'answer' => 'Briefcase simplifies the process of finding and contacting legal practitioners by providing a centralized platform with advanced   search and communication tools. This saves you time and effort   compared to traditional methods.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'Can I get legal advice directly through Briefcase?',
                'answer' => 'You can communicate with legal practitioners through Briefcase, but direct legal advice will be provided by the practitioners during these interactions.',
                'type' => FAQLangEnum::en,
            ]
        );
        FAQ::create(
            [
                'question' => 'How do I leave a review for a legal practitioner?',
                'answer' => 'After your interaction with a legal practitioner, you can leave   a review and rate their services on their profile page. This feedback helps other clients and maintains the quality of our   platform.',
                'type' => FAQLangEnum::en,
            ]
        );

        FAQ::create(
            [
                'question' => 'ما هي منصة "بريفكيس"؟',
                'answer' => '”بريفكيس" هي منصة تربط المحترفين القانونيين بالعملاء والممارسين القانونيين الآخرين. مهمتنا هي تبسيط الممارسة القانونية من خلال  توفير أدوات وموارد متقدمة لتعزيز نطاقك وكفاءتك.',
                'type' => FAQLangEnum::ar,
            ]
        );

        FAQ::create(
            [
                'question' => 'كيف أسجل في "بريفكيس"؟',
                'answer' => 'التسجيل بسيط ومجاني. فقط اضغط على زر "التسجيل" في صفحتنا الرئيسية، واملأ بياناتك، واتبع التعليمات لإكمال التسجيل',
                'type' => FAQLangEnum::ar,
            ]
        );

        FAQ::create(
            [
                'question' => 'هل هناك تكلفة لاستخدام  "بريفكيس"؟',
                'answer' => 'ل، التسجيل واستخدام الميزات الأساسية في "بريفكيس" مجاني تماًما. نحن نقدم ميزات متميزة بأسعار تنافسية لأولئك الذين يرغبون في تحسين ممارستهم.',
                'type' => FAQLangEnum::ar,
            ]
        );

        FAQ::create(
            [
                'question' => 'ما هي الأدوات والموارد التي يوفرها "بريفكيس"؟',
                'answer' => 'يوفر "بريفكيس" مجموعة متنوعة من الأدوات والموارد بما في ذلك إدارة القضايا، مشاركة الوثائق، التواصل مع العملاء، وشبكة من المحترفين  القانونيين لتعزيز التعاون وتبادل المعرفة.',
                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يمكن أن يساعد "بريفكيس"في ممارستي القانونية؟ ',
                'answer' => 'يساعدك "بريفكيس" في إدارة ممارستك بشكل أكثر كفاءة من خالل توفير أدوات لإدارة القضايا، التواصل مع العملاء، والشبكات. كما يزيد من رؤيتك للعمالء المحتملين ويسمح لك بالتعاون مع محامين آخرين',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'هل يمكنني الوصول إلى"بريفكيس"من جهازي المحمول؟',
                'answer' => 'نعم، يمكن الوصول إلى "بريفكيس" من أي جهاز متصل بالإنترنت، بما في ذلك الهواتف الذكية والأجهزة اللوحية. هذا يتيح لك إدارة ممارستك أثناء التنقل.',
                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'مامدى أمان معلوماتي على"بريفكيس"؟',
                'answer' => 'نحن نأخذ الأمان على محمل الجد. يتم تشفير جميع بياناتك وتخزينها بأمان. نحن نلتزم بأعلى معايير حماية البيانات والخصوصية لضمان أمان معلوماتك.',
                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف أتواصل مع الدعم إذا كان لدي مشكلة“؟',
                'answer' => 'يمكنك التواصل مع فريق الدعم لدينا عبر البريد الإلكتروني على com.BriefcasePlatfrom@Info. نحن هنا لمساعدتك في أي مشكالت أو أسئلة قد تكون لديك.',

                'type' => FAQLangEnum::ar,
            ]
        );

        FAQ::create(
            [
                'question' => 'ما هي العملية لإدارة مدفوعات العملاء عبر "بريفكيس"؟',
                'answer' => 'يوفر "بريفكيس" ميزات معالجة المدفوعات الآمنة التي تسمح للعمالء بدفع رسوم خدماتك مباشرة عبر المنصة. يمكنك إدارة الفواتير، وتتبع  المدفوعات، وضمان المعامالت في الوقت المناسب ضمن إعدادات حسابك.',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يساعد "بريفكيس" في اكتساب العملاء؟',
                'answer' => 'يزيد "بريفكيس" من رؤيتك للعمالء المحتملين من خالل خوارزميات البحث والمطابقة. من خالل الحفاظ على ملف شخصي محدث ومفصل، تزيد فرصك في التطابق مع العملاء الذين يبحثون عن خبرتك المحددة',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف أضمن أن ملفي الشخصي يبرز للعملاء المحتملين؟',
                'answer' => 'جعل ملفك الشخصي يبرز، تأكد من أنه مكتمل ومحدث، بما في ذلك أوصاف مفصلة لخبراتك وتجاربك. يمكن أن تضيف شهادات العملاء ودراسات  الحالة أيضا إلى جاذبية ملفك الشخصي',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يمكنني إدارة قضاياي على"بريفكيس"؟',
                'answer' => 'يوفر "بريفكيس" نظاًما شامًال لإدارة القضايا حيث يمكنك إنشاء وتحديث وتتبع القضايا. يمكنك تنظيم الوثائق، وتحديد تذكيرات بالمواعيد النهائية، والتواصل مع العملاء والزملاء داخل المنصة.',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'هل يمكنني قراءة التقييمات والتعليقات عن الممارسين القانونيين؟
                ',
                'answer' => 'نعم، يتيح لك "بريفكيس" قراءة التقييمات والتعليقات من العمالء الآخرين. هذا يساعدك في اتخاذ قرار مستنير عند اختيار ممارس قانوني.
                ',
                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يوفر "بريفكيس" الوقت والجهد؟',
                'answer' => 'يبسط "بريفكيس" عملية العثور على الممارسين القانونيين والتواصل معهم من خالل توفير منصة مركزية بأدوات بحث واتصال متقدمة. هذا يوفر لك الوقت والجهد مقارنة بالطرق التقليدية.',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'هل يمكنني الحصول على المشورة القانونية مباشرة من خلال "بريفكيس"؟
',
                'answer' => 'يمكنك تحديد مواعيد االستشارات والتواصل مع الممارسين القانونيين من خالل "بريفكيس"، ولكن سيتم تقديم المشورة القانونية المباشرة من قبل الممارسين خالل هذه التفاعلات.',


                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف أترك تقييماً لممارس قانوني؟',
                'answer' => 'بعد تفاعلك مع ممارس قانوني، يمكنك ترك تقييم وتقييم خدماتهم على صفحة ملفهم الشخصي. هذا يساعد العمالء الآخرين ويحافظ على جودة منصتنا.
',

                'type' => FAQLangEnum::ar,
            ]
        );

        FAQ::create(
            [
                'question' => 'هل يمكنني التواصل مع محامين آخرين على "بريفكيس"؟
',
                'answer' => 'نعم، كمحامي توفر "بريفكيس" ميزة للتواصل تتيح لك االتصال بمحامين. يمكنك تبادل المعرفة، وطلب النصائح، والتعاون في القضايا.
',
                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يساعد "بريفكيس" في اكتساب العملاء؟',
                'answer' => 'يزيد "بريفكيس" من رؤيتك للعمالء المحتملين من خالل خوارزميات البحث والمطابقة. من خالل الحفاظ على ملف شخصي محدث ومفصل، تزيد فرصك في التطابق مع العمالء الذين يبحثون عن خبرتك المحددة',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'ماالذي يجعل "بريفكيس" مختلفاً عن المنصات القانونية الأخرى؟
                ',
                'answer' => 'تتميز منصة "بريفكيس" بالتسجيل المجاني ومجموعة شاملة من الأدوات المصممة خصيصا للمحترفين القانونيين. يميزنا تركيزنا على ربط المحترفين القانونيين وتوفير موارد عالية الجودة. نحن نعمل حالًيا في الإمارات العربية المتحدة، مع خطط للتوسع عالمًيا في المستقبل القريب.
                ',
                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يمكنني تقديم ملاحظات أو اقتراحات لتحسين "بريفكيس"؟
                ',
                'answer' => 'نرحب بالمالحظات واالقتراحات من مستخدمينا. يمكنك تقديم المالحظات مباشرة عبر نموذج المالحظات على المنصة أو عن طريق االتصال بفريق الدعم لدينا. نحن نسعى دائًما لتحسين خدماتنا بناًء على مدخالت المستخدمين',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'ماذا لو الإستشارة التي قُدمت ليست صحيحة؟
                ',
                'answer' => 'يمكن لفريق دعم ”بريفكيس“ ان يتدخل اذا تم تقديم استشارة ليست لها صله بالموضوع الذي ترغب الإستشارة فيه.
                ',
                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف أجد ممارساً قانونياً على "بريفكيس"؟
',
                'answer' => 'يمكنك البحث عن الممارسين القانونيين باستخدام فالتر مختلفة مثل مجال القانون، الموقع، والخبرة. تساعدك وظيفة البحث المتقدمة في العثور على أفضل مطابقة الحتياجاتك القانونية.',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'هل هناك تكلفة الستخدام "بريفكيس" للعثور على محامٍ؟
                ',
                'answer' => 'لا, استخدام "بريفكيس" للبحث عن الممارسين القانونيين والتواصل معهم مجاني للعمالء. قد تحتاج فقط إلى دفع رسوم الخدمات القانونية التي تختارها',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يمكنني التأكد من أن الممارسين القانونيين على"بريفكيس" مؤهلين؟',
                'answer' => 'يتم فحص جميع الممارسين القانونيين على "بريفكيس" لضمان أنهم مؤهلين وفي وضع جيد. نقوم بمراجعة مؤهالتهم وخبراتهم ومراجعات العمالء للحفاظ على مستوى عاٍل من الخدمة',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف يمكنني الاتصال بممارس قانوني على "بريفكيس"؟',
                'answer' => ' بمجرد العثور على ممارس قانوني يناسب احتياجاتك، يمكنك القيام بذلك اتصل بهم مباشرة من خلال المنصة باستخدام تطبيقنا الآمن نظام الرسائل.',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف توفر لي "بريفكيس " الوقت والجهد؟',
                'answer' => 'تعمل بريفكيس  على تبسيط عملية البحث عن القانونيين والاتصال بهم الممارسين من خلال توفير منصة مركزية مع المتقدمة أدوات البحث والاتصال. وهذا يوفر عليك الوقت والجهد مقارنة بالطرق التقليدية.',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'هل يمكنني الحصول على المشورة القانونية مباشرة من خلال "بريفكيس "؟',
                'answer' => 'يمكنك التواصل مع الممارسين القانونيين من خلال  بريفكيس  ولكن سيتم تقديم المشورة القانونية المباشرة من قبل الممارسين  خلال هذه التفاعلات.',

                'type' => FAQLangEnum::ar,
            ]
        );
        FAQ::create(
            [
                'question' => 'كيف أترك مراجعة للممارس القانوني؟',
                'answer' => 'بعد تفاعلك مع الممارس القانوني، يمكنك المغادرة مراجعة وتقييم خدماتهم على صفحة الملف الشخصي الخاصة بهم. هذا تساعد التعليقات العملاء الآخرين وتحافظ على جودة خدماتنا منصة.',

                'type' => FAQLangEnum::ar,
            ]
        );

    }
}
