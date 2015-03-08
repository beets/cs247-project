Router.route('/timeline', function() {
    this.layout('layout');
    this.render('timeline');
});

Router.route('/story/add', function() {
    this.layout('layout');
    this.render('story-add');

});

    if (Meteor.isClient) {
        Template.body.events({
            "click .upload-photo": function() {
                console.log('hello');
            },

            "click #send": function() {
                Router.go('/timeline');
            },
        });
    }
