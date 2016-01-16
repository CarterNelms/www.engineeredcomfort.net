/* To add a new testimonyy, create a new line in both lists below.
1. The first list contains the names of the people who testified for Engineered Comfort.
The second contains the testimonies they gave.
2. Make sure that the lines in both lists correspond to each other (same position in the list).
3. Use the same format in each list that you see used for the previous entries.
4. You can use html tags in any of the list entries.*/

function getTestifyers(){
// This is a list of the people who have testified for Engineered Comfort. Any repeated names should be listed back to back.
var testifyers = new Array();
testifyers[0] = "Suzanne";
testifyers[1] = "Mitchell L.";
testifyers[2] = "Roger F.";
testifyers[3] = "Tim H.";
testifyers[4] = "Milton R.";
testifyers[5] = "Ronnie B.";
testifyers[6] = "Ronnie B.";
testifyers[7] = "Anne M.";
testifyers[8] = "Anne M.";
testifyers[9] = "George Y.";
testifyers[10] = "George Y.";
return testifyers;
}

function getTestimonies(){
// This is a list of the corresponding testimonies from the 'testifyers' array. Any quote broken into pieces should be listed in order.
var testimonies = new Array();
testimonies[0] = "In 39 years of marriage we have <em><i>never</i></em> had anyone respond <em><i>so</i></em> promptly and do such a GREAT job of getting our air conditioning up and running. <u>Thank</u> <u>you</u> <u>so</u> much.";
testimonies[1] = "Just wanted to let you know my average MLGW bill was $74/month last year. I have 4200 sq ft and installed the single 5 ton DFHP. What a great system you installed! Thanks!";
testimonies[2] = "I... feel that a great job has been done on the insulation.";
testimonies[3] = "I really appreciate your responsiveness and attention to detail whenever I call with problems. It is a pleasure doing business with you.";
testimonies[4] = "I wanted to thank you for the prompt response to my A/C problem and tell you how professional, efficient, and pleasant [your employees] were. They are excellent representatives of your company. I have already recommended you to a co-worker who needs routine service on her unit soon.";
testimonies[5] = "I would like to thank you for getting our air conditioning fixed so quickly. I removed the window units yesterday & the house was at 75 degrees this morning & the unit had cycled off. A welcoming sound we had not heard in a while. The work in the attic looked great & very professional.";
testimonies[6] = "My wife said that all of your guys were very courteous & respectful around her & my son. After being in the construction industry for several years, I know how guys can act & talk. I appreciate the professionalism of your guys. When we decide to build our next house, I will keep you in mind so we can get it done right the first time.";
testimonies[7] = "Words cannot express how much more comfortable our home is since your work was finished. We used to walk through pockets of burning hot and freezing cold air as we went from room to room. Now the entire house is a consistent temperature, and warm even though I've got everything set on 65 degrees. People used to complain that our house was freezing, and now it is perfect! I feel like Goldilocks after she found baby bear's porridge!!";
testimonies[8] = "Your crew was so professional and as unintrusive as possible... If you ever need a recommendation, be SURE to use us!";
testimonies[9] = "I wanted to tell you what a great bunch of workers are insulating my home. [They] are doing a phenominal detailed job. <u>Please pass along a positive note/kudos to them all for me as I really appreciate their GREAT work!!</u>";
testimonies[10] = "Thanks for the great work!";
return testimonies;
}