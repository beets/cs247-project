Router.route('/timeline', function() {
    this.layout('layout');
    this.render('timeline');

    Template.timeline_new.events({
        "click .timeline_new .add_story": function() {
            Router.go('/story/add');
        },
    });

    Template.timeline.helpers({
        story: function() {
            return Stories.find({});
        }
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

            "click #send": function(event) {
                var parentDiv = $(event.target).parents('.main-photo');
                var title = parentDiv.children('input[name=title]').get(0).value;
                console.log(title);
                Stories.insert({
                    title: title,
                    // story date
                    createdAt: new Date()
                });

                Router.go('/timeline');
                return false;
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

Stories = new Mongo.Collection("stories");
