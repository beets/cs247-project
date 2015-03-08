Router.route('/timeline', function() {
    this.layout('layout');
    this.render('timeline');

    Template.timeline_new.events({
        "click .timeline_new .add_story": function() {
            Router.go('/story/add');
        },
    });
});

Router.route('/story/add', function() {
    this.layout('layout');
    this.render('story_add');

    if (Meteor.isClient) {
        Template.story_add.events({
            "click .upload-photo": function() {
                console.log('hello');
            },
            "click #send": function() {
                Router.go('/timeline');
            }
        });

/*
        Template.story_add.helpers({
            comments: [
                {
            ]
        });
*/
    }
});
