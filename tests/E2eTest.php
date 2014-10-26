<?php
namespace Cbcoverseas;

use PHPUnit_Framework_TestCase as TestCase;

class E2eTest extends TestCase {
	
	/**
	 * Clicking like should not immediately send/schedule email notifications.
	 * 
	 * Liking something may leak confidential info that we don't want to leak.
	 * Email is not a secure enough medium for our needs.
	 * 
	 * 1. Assume we have a user and a post by someone else
	 * 2. User likes the post (action: likes/add)
	 * 3. Check that no notifications were scheduled/sent to post's owner
	 */
	public function testLikesDoesNotSendEmailNotification() {
		$this->markTestIncomplete("Requires manual testing for now");
	}

	/**
	 * Private messages should not immediately send/schedule email notifications.
	 * 
	 * Private messages may contain confidential info that we don't want to leak.
	 * Email is not a secure enough medium for our needs.
	 * 
	 * 1. Assume we have users A and B
	 * 2. User A sends user B a private message (action: messages/send)
	 * 3. Check that no notifications were scheduled/sent to user B
	 */
	public function testPrivateMessageDoesNotSendEmailNotification() {
		$this->markTestIncomplete("Requires manual testing for now");
	}
	
	/**
	 * Blog urls must not contain the title (not even a url-friendly version)
	 * 
	 * Urls can easily be leaked publicly (e.g. in notifications).
	 * The titles may have confidential info that we don't want to leak.
	 * 
	 * 1. Create a new blog with a title with some "magic" string (asg323e32r4)
	 * 2. Check that the Url for the blog doesn't contain the magic string
	 */
	public function testBlogUrlsShouldNotContainTheTitle() {
		$this->markTestIncomplete('Requires manual testing for now');
	}

	/**
	 * Image urls must not contain the title (not even a url-friendly version)
	 * 
	 * Urls can easily be leaked publicly (e.g. in notifications).
	 * The titles may have confidential info that we don't want to leak.
	 * 
	 * 1. Create a new image with a title with some "magic" string (asg323e32r4)
	 * 2. Check that the Url for the image doesn't contain the magic string
	 */
	public function testImageUrlsShouldNotContainTheTitle() {
		$this->markTestIncomplete('Requires manual testing for now');
	}
	
	
	/**
	 * The access options for posts should be limited to totally private or logged-in.
	 * 
	 * All content should be visible to all members of the site by default.
	 * Private is mainly just for testing/drafts.
	 * 
	 * TODO(ewinslow): Consider removing "private" option. Has been confusing in the past.
	 * 
	 * 1. Create a blog and try to save it with access = public.
	 * 2. Check that this fails.
	 * 3. Render the input/access form field.
	 * 4. Check that the only options are "logged-in" and "private".
	 */
	public function testAccessOptionsShouldBeLimitedToPrivateOrLoggedIn() {
		$this->markTestIncomplete('Requires manual testing for now');
	}
	
	/**
	 * Only certain users should be able to post to the stream.
	 * 
	 * In the past we had it open for everyone to be able to post to the stream,
	 * but that got out of hand because well-meaning folks would put things like
	 * "Hope you're doing ok!" and then everyone would get a notification for that.
	 * 
	 * Instead, we only want the main stream to be updates from the people this
	 * site was meant to keep us in touch with.
	 * 
	 * 1. Add non-admin user A to the whitelist
	 * 2. Try to post an album, blog, image, tidypics_batch, comment
	 * 3. Verify that these all succeed.
	 * 
	 * 4. Remove user A from the whitelist
	 * 5. Try to post an album, blog, image, tidypics_batch
	 * 6. Verify that these all fail
	 * 7. Try to post a comment
	 * 8. Verify that this succeeds
	 */
	public function testOnlyWhitelistedMembersCanPostToStream() {
		$this->markTestIncomplete('Requires manual testing for now');
	}
	
	/**
	 * Admins can always post to the stream, even if they aren't on the whitelist.
	 * 
	 * Admin is a special role within Elgg that should not have its permissions restricted.
	 * 
	 * 1. Assume we have an admin that isn't on the whitelist.
	 * 2. Try to post an album, blog, image, tidypics_batch, comment
	 * 3. Verify that these all succeed
	 */
	public function testAdminsCanAlwaysPostToTheStream() {
		$this->markTestIncomplete('Requires manual testing for now');
		
		// TODO(ewinslow): This is actually broken right now, I belive
	}
	
	/**
	 * We need the whitelist to be admin-configurable so that:
	 *  1. We don't have to update code every time a content author is added.
	 *  2. We don't have to tie code to a particular instance of the DB with particular usernames.
	 * 
	 * 1. Go to the plugin settings page for this plugin.
	 * 2. Assuming we have users A, B, and C, add user A to the whitelist.
	 * 3. Submit the form.
	 * 4. Check that user A is on the whitelist and B and C are not.
	 */
	public function testPostingWhitelistIsEditableFromPluginSettings() {
		$this->markTestIncomplete('Requires manual testing for now');
	}

	/**
	 * Cheap hosts can have an hourly rate-limit on emails, so we send digests hourly.
	 * 
	 * 1. Hit the cron/hourly hook.
	 * 2. Check that exactly one batch of emails was sent.
	 */
	public function testEmailDigestsAreSentOutHourly() {
		$this->markTestIncomplete('Requires manual testing for now');
	}
}