<?php

use Illuminate\Database\Seeder;
use Corp\Portfolio;

class PortfoliosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Portfolio::create(
            [
                'title'=>'Steep This!',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'Steep This!',
                'alias'=>'project1',
                'image'=>'{"mini":"0061-175x175.jpg","max":"0061-770x368.jpg","path":"0061.jpg"}',
                'created_at'=>'2017-04-19 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Kineda',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'customer',
                'alias'=>'project2',
                'image'=>'{"mini":"009-175x175.jpg","max":"009-770x368.jpg","path":"009.jpg"}',
                'created_at'=>'2017-04-20 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Love',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'zero',
                'alias'=>'project3',
                'image'=>'{"mini":"0011-175x175.jpg","max":"0043-770x368.jpg","path":"0043.jpg"}',
                'created_at'=>'2017-04-21 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Guanacos',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'Steep This!',
                'alias'=>'project4',
                'image'=>'{"mini":"0027-175x175.jpg","max":"0027-770x368.jpg","path":"0027.jpg"}',
                'created_at'=>'2017-04-22 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Miller Bob',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'customer',
                'alias'=>'project5',
                'image'=>'{"mini":"0071-175x175.jpg","max":"0071-770x368.jpg","path":"0071.jpg"}',
                'created_at'=>'2017-04-23 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Nili Studios',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'zero',
                'alias'=>'project6',
                'image'=>'{"mini":"0052-175x175.jpg","max":"0052-770x368.jpg","path":"0052.jpg"}',
                'created_at'=>'2017-04-24 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Vitale Premium',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'Steep This!',
                'alias'=>'project7',
                'image'=>'{"mini":"0081-175x175.jpg","max":"0081-770x368.jpg","path":"0081.jpg"}',
                'created_at'=>'2017-04-25 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Digitpool Medien',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'customer',
                'alias'=>'project8',
                'image'=>'{"mini":"0071-175x175.jpg","max":"0071.jpg","path":"0071-770x368.jpg"}',
                'created_at'=>'2017-04-26 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
        Portfolio::create(
            [
                'title'=>'Octopus',
                'text'=>'Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.\r\n\r\nDonec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.\r\n\r\nSed porttitor eros ut purus elementum a consectetur purus vulputate',
                'customer'=>'zero',
                'alias'=>'project9',
                'image'=>'{"mini":"0081-175x175.jpg","max":"0081.jpg","path":"0081-770x368.jpg"}',
                'created_at'=>'2017-04-27 16:34:42',
                'filter_alias'=>'brand-identity',
            ]
        );
    }
}
